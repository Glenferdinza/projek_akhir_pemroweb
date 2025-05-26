<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventCategory;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    // Remove the constructor middleware for now
    // We'll handle authentication in routes instead

    /**
     * Display a listing of events
     */
    public function index(Request $request)
    {
        $query = Event::with(['creator', 'registrations'])
                      ->where('is_active', true)
                      ->where('start_date', '>', now());

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('organizer', 'like', '%' . $request->search . '%');
            });
        }

        // Featured events
        if ($request->has('featured')) {
            $query->where('is_featured', true);
        }

        $events = $query->orderBy('start_date', 'asc')->paginate(12);

        if ($request->expectsJson()) {
            return response()->json($events);
        }

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new event
     */
    public function create()
    {
        $categories = EventCategory::where('is_active', true)->get();
        return view('events.create', compact('categories'));
    }

    /**
     * Store a newly created event
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'start_date' => 'required|date|after:now',
            'end_date' => 'required|date|after:start_date',
            'location' => 'nullable|string|max:255',
            'organizer' => 'required|string|max:255',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string|max:20',
            'max_participants' => 'nullable|integer|min:1',
            'registration_fee' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'requirements' => 'nullable|array',
            'additional_info' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $eventData = $request->all();
        $eventData['created_by'] = Auth::id();
        $eventData['is_active'] = true;

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
            $eventData['image_url'] = Storage::url($imagePath);
        }

        // Handle requirements array properly
        if (isset($eventData['requirements']) && is_array($eventData['requirements'])) {
            $eventData['requirements'] = json_encode($eventData['requirements']);
        }

        $event = Event::create($eventData);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Event created successfully!',
                'event' => $event->load('creator')
            ], 201);
        }

        return redirect()->route('events.show', $event)
                        ->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified event
     */
    public function show(Event $event)
    {
        $event->load(['creator', 'registrations.user']);
        
        $isRegistered = Auth::check() 
            ? $event->registrations()->where('user_id', Auth::id())->exists()
            : false;

        if (request()->expectsJson()) {
            return response()->json([
                'event' => $event,
                'is_registered' => $isRegistered
            ]);
        }

        return view('events.show', compact('event', 'isRegistered'));
    }

    /**
     * Show the form for editing event
     */
    public function edit(Event $event)
    {
        // Check if user can edit this event
        if ($event->created_by !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $categories = EventCategory::where('is_active', true)->get();
        return view('events.edit', compact('event', 'categories'));
    }

    /**
     * Update the specified event
     */
    public function update(Request $request, Event $event)
    {
        // Check if user can update this event
        if ($event->created_by !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action.'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'location' => 'nullable|string|max:255',
            'organizer' => 'required|string|max:255',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string|max:20',
            'max_participants' => 'nullable|integer|min:1',
            'registration_fee' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'requirements' => 'nullable|array',
            'additional_info' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $eventData = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($event->image_url) {
                $oldImagePath = str_replace('/storage/', '', $event->image_url);
                Storage::disk('public')->delete($oldImagePath);
            }
            
            $imagePath = $request->file('image')->store('events', 'public');
            $eventData['image_url'] = Storage::url($imagePath);
        }

        // Handle requirements array properly
        if (isset($eventData['requirements']) && is_array($eventData['requirements'])) {
            $eventData['requirements'] = json_encode($eventData['requirements']);
        }

        $event->update($eventData);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Event updated successfully!',
                'event' => $event->fresh()->load('creator')
            ]);
        }

        return redirect()->route('events.show', $event)
                        ->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified event
     */
    public function destroy(Event $event)
    {
        // Check if user can delete this event
        if ($event->created_by !== Auth::id()) {
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized action.'
                ], 403);
            }
            abort(403);
        }

        // Delete image if exists
        if ($event->image_url) {
            $imagePath = str_replace('/storage/', '', $event->image_url);
            Storage::disk('public')->delete($imagePath);
        }

        $event->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Event deleted successfully!'
            ]);
        }

        return redirect()->route('events.index')
                        ->with('success', 'Event deleted successfully!');
    }

    /**
     * Register user for an event
     */
    public function register(Request $request, Event $event)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to register for events'
            ], 401);
        }

        // Check if event is full
        if ($event->max_participants && $event->registrations()->count() >= $event->max_participants) {
            return response()->json([
                'success' => false,
                'message' => 'Event is full'
            ], 400);
        }

        // Check if already registered
        $existingRegistration = EventRegistration::where([
            'event_id' => $event->id,
            'user_id' => Auth::id()
        ])->first();

        if ($existingRegistration) {
            return response()->json([
                'success' => false,
                'message' => 'You are already registered for this event'
            ], 400);
        }

        // Check if event has passed
        if ($event->start_date < now()) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot register for past events'
            ], 400);
        }

        $registration = EventRegistration::create([
            'event_id' => $event->id,
            'user_id' => Auth::id(),
            'registered_at' => now(),
            'registration_status' => 'confirmed',
            'additional_data' => json_encode($request->input('additional_data', [])),
            'amount_paid' => $event->registration_fee ?? 0
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Successfully registered for the event!',
            'registration' => $registration
        ]);
    }

    /**
     * Cancel event registration
     */
    public function cancelRegistration(Event $event)
    {
        $registration = EventRegistration::where([
            'event_id' => $event->id,
            'user_id' => Auth::id()
        ])->first();

        if (!$registration) {
            return response()->json([
                'success' => false,
                'message' => 'Registration not found'
            ], 404);
        }

        $registration->update(['registration_status' => 'cancelled']);

        return response()->json([
            'success' => true,
            'message' => 'Registration cancelled successfully'
        ]);
    }

    /**
     * Get user's events (created or registered)
     */
    public function myEvents()
    {
        $user = Auth::user();
        
        $createdEvents = Event::where('created_by', $user->id)
                             ->with('registrations')
                             ->orderBy('created_at', 'desc')
                             ->get();
                             
        $registeredEvents = EventRegistration::where('user_id', $user->id)
                                           ->with('event')
                                           ->orderBy('registered_at', 'desc')
                                           ->get()
                                           ->pluck('event')
                                           ->filter();

        if (request()->expectsJson()) {
            return response()->json([
                'created_events' => $createdEvents,
                'registered_events' => $registeredEvents
            ]);
        }

        return view('events.my-events', compact('createdEvents', 'registeredEvents'));
    }

    /**
     * Search events
     */
    public function search(Request $request)
    {
        $query = $request->input('q');
        
        if (!$query) {
            return response()->json([
                'success' => false,
                'message' => 'Search query is required'
            ], 400);
        }

        $events = Event::where(function($q) use ($query) {
            $q->where('title', 'like', '%' . $query . '%')
              ->orWhere('description', 'like', '%' . $query . '%')
              ->orWhere('organizer', 'like', '%' . $query . '%');
        })
        ->where('is_active', true)
        ->where('start_date', '>', now())
        ->with('creator')
        ->limit(10)
        ->get();

        return response()->json([
            'success' => true,
            'events' => $events
        ]);
    }

    /**
     * View created events by current user
     */
    public function viewCreatedEvents()
    {
        $events = Event::where('created_by', Auth::id())
                      ->with('registrations')
                      ->orderBy('created_at', 'desc')
                      ->get();
                      
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'events' => $events
            ]);
        }
                      
        return view('events.created', compact('events'));
    }

    /**
     * Join event (alias for register)
     */
    public function join(Request $request, Event $event)
    {
        // Sama dengan register, bisa disesuaikan jika ada perbedaan logic
        return $this->register($request, $event);
    }

    /**
     * Get events for API/AJAX requests
     */
    public function getEvents(Request $request)
    {
        $query = Event::with(['creator', 'registrations'])
                      ->where('is_active', true)
                      ->where('start_date', '>', now());

        // Add filters similar to index method
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('organizer', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('featured')) {
            $query->where('is_featured', true);
        }

        $events = $query->orderBy('start_date', 'asc')->paginate(12);
                  
        return response()->json([
            'success' => true,
            'data' => $events
        ]);
    }
}