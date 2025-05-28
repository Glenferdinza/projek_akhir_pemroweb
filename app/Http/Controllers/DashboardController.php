<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\User;
use App\Models\EventRegistration;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get basic stats
        $stats = $this->getBasicStats($user);
        
        // Get recent events
        $recentEvents = $this->getUserRecentEvents($user);
        
        // Get upcoming events user is registered for
        $upcomingEvents = $this->getUpcomingRegisteredEvents($user);
        
        return view('dashboard', compact('user', 'stats', 'recentEvents', 'upcomingEvents'));
    }

    /**
     * Get dashboard statistics via API
     */
    public function getStats()
    {
        $user = Auth::user();
        $stats = $this->getBasicStats($user);
        
        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }

    /**
     * Get recent events for dashboard
     */
    public function getRecentEvents()
    {
        $user = Auth::user();
        $recentEvents = $this->getUserRecentEvents($user);
        
        return response()->json([
            'success' => true,
            'data' => $recentEvents
        ]);
    }

    /**
     * Get notifications for user
     */
    public function getNotifications()
    {
        $user = Auth::user();
        
        // Get upcoming events user is registered for
        $upcomingEvents = EventRegistration::with('event')
            ->where('user_id', $user->id)
            ->whereHas('event', function($query) {
                $query->where('event_date', '>=', Carbon::now())
                      ->where('event_date', '<=', Carbon::now()->addDays(7));
            })
            ->limit(5)
            ->get();

        // Get events created by user that are starting soon
        // Change 'user_id' to the actual column name in your events table
        $myUpcomingEvents = Event::where('created_by', $user->id) // or 'organizer_id'
            ->where('event_date', '>=', Carbon::now())
            ->where('event_date', '<=', Carbon::now()->addDays(7))
            ->limit(5)
            ->get();

        $notifications = [
            'registered_events' => $upcomingEvents->map(function($registration) {
                return [
                    'type' => 'event_reminder',
                    'title' => 'Event Reminder',
                    'message' => "Event '{$registration->event->title}' akan dimulai pada " . 
                               Carbon::parse($registration->event->event_date)->format('d M Y H:i'),
                    'date' => $registration->event->event_date,
                    'event_id' => $registration->event->id
                ];
            }),
            'my_events' => $myUpcomingEvents->map(function($event) {
                return [
                    'type' => 'my_event_reminder',
                    'title' => 'Event Management',
                    'message' => "Event Anda '{$event->title}' akan dimulai pada " . 
                               Carbon::parse($event->event_date)->format('d M Y H:i'),
                    'date' => $event->event_date,
                    'event_id' => $event->id
                ];
            })
        ];

        return response()->json([
            'success' => true,
            'data' => $notifications
        ]);
    }

    /**
     * Get chart data for dashboard
     */
    public function getChartData()
    {
        $user = Auth::user();
        
        // Events created by user per month (last 6 months)
        // Change 'user_id' to the actual column name in your events table
        $eventsCreated = Event::where('created_by', $user->id) // or 'organizer_id'
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as count')
            ->groupBy('month', 'year')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Events registered by user per month (last 6 months)
        $eventsRegistered = EventRegistration::where('user_id', $user->id)
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as count')
            ->groupBy('month', 'year')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Format data for chart
        $months = [];
        $createdData = [];
        $registeredData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthKey = $date->format('M Y');
            $months[] = $monthKey;
            
            $created = $eventsCreated->where('month', $date->month)
                                   ->where('year', $date->year)
                                   ->first();
            $createdData[] = $created ? $created->count : 0;
            
            $registered = $eventsRegistered->where('month', $date->month)
                                         ->where('year', $date->year)
                                         ->first();
            $registeredData[] = $registered ? $registered->count : 0;
        }

        return response()->json([
            'success' => true,
            'data' => [
                'labels' => $months,
                'datasets' => [
                    [
                        'label' => 'Events Created',
                        'data' => $createdData,
                        'backgroundColor' => 'rgba(59, 130, 246, 0.8)',
                        'borderColor' => 'rgba(59, 130, 246, 1)',
                        'borderWidth' => 2
                    ],
                    [
                        'label' => 'Events Registered',
                        'data' => $registeredData,
                        'backgroundColor' => 'rgba(16, 185, 129, 0.8)',
                        'borderColor' => 'rgba(16, 185, 129, 1)',
                        'borderWidth' => 2
                    ]
                ]
            ]
        ]);
    }

    /**
     * Get recent activities for dashboard
     */
    public function getRecentActivities()
    {
        $user = Auth::user();
        
        $activities = collect();

        // Recent events created
        // Change 'user_id' to the actual column name in your events table
        $recentCreated = Event::where('created_by', $user->id) // or 'organizer_id'
            ->latest()
            ->limit(5)
            ->get()
            ->map(function($event) {
                return [
                    'type' => 'event_created',
                    'title' => 'Event Created',
                    'description' => "You created event '{$event->title}'",
                    'date' => $event->created_at,
                    'event_id' => $event->id,
                    'icon' => 'plus-circle',
                    'color' => 'blue'
                ];
            });

        // Recent registrations
        $recentRegistrations = EventRegistration::with('event')
            ->where('user_id', $user->id)
            ->latest()
            ->limit(5)
            ->get()
            ->map(function($registration) {
                return [
                    'type' => 'event_registered',
                    'title' => 'Event Registration',
                    'description' => "You registered for '{$registration->event->title}'",
                    'date' => $registration->created_at,
                    'event_id' => $registration->event->id,
                    'icon' => 'calendar-check',
                    'color' => 'green'
                ];
            });

        // Merge and sort activities
        $activities = $recentCreated->merge($recentRegistrations)
            ->sortByDesc('date')
            ->take(10)
            ->values();

        return response()->json([
            'success' => true,
            'data' => $activities
        ]);
    }

    /**
     * Get basic statistics for user
     */
    private function getBasicStats($user)
    {
        $stats = [
            // Change 'user_id' to the actual column name in your events table
            'events_created' => Event::where('created_by', $user->id)->count(), // or 'organizer_id'
            'events_registered' => EventRegistration::where('user_id', $user->id)->count(),
            'upcoming_events' => EventRegistration::where('user_id', $user->id)
                ->whereHas('event', function($query) {
                    $query->where('event_date', '>=', Carbon::now());
                })
                ->count(),
            // Change 'user_id' to the actual column name in your events table
            'total_attendees' => Event::where('created_by', $user->id) // or 'organizer_id'
                ->withCount('registrations')
                ->get()
                ->sum('registrations_count')
        ];

        return $stats;
    }

    /**
     * Get recent events for user
     */
    private function getUserRecentEvents($user)
    {
        // Change 'user_id' to the actual column name in your events table
        return Event::where('created_by', $user->id) // or 'organizer_id'
            ->latest()
            ->limit(5)
            ->get()
            ->map(function($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'start_date' => $event->event_date, // changed from start_date to event_date
                    'location' => $event->location,
                    'registrations_count' => $event->registrations_count ?? 0,
                    'status' => Carbon::parse($event->event_date)->isPast() ? 'completed' : 'upcoming'
                ];
            });
    }

    /**
     * Get upcoming events user is registered for
     */
    private function getUpcomingRegisteredEvents($user)
    {
        return EventRegistration::with('event')
            ->where('user_id', $user->id)
            ->whereHas('event', function($query) {
                $query->where('event_date', '>=', Carbon::now());
            })
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function($registration) {
                return [
                    'id' => $registration->event->id,
                    'title' => $registration->event->title,
                    'start_date' => $registration->event->event_date, // changed from start_date to event_date
                    'location' => $registration->event->location,
                    'registration_date' => $registration->created_at
                ];
            });
    }
}