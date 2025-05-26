<?php
namespace App\Http\Controllers;

use App\Models\EventCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventCategoryController extends Controller
{
    public function index()
    {
        $categories = EventCategory::active()
                                  ->withCount('events')
                                  ->orderBy('name')
                                  ->get();

        if (request()->expectsJson()) {
            return response()->json($categories);
        }

        return view('categories.index', compact('categories'));
    }

    public function show(EventCategory $category)
    {
        $events = $category->events()
                          ->active()
                          ->upcoming()
                          ->with('creator')
                          ->paginate(12);

        if (request()->expectsJson()) {
            return response()->json([
                'category' => $category,
                'events' => $events
            ]);
        }

        return view('categories.show', compact('category', 'events'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:event_categories',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'color' => 'nullable|string|regex:/^#[A-Fa-f0-9]{6}$/'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $category = EventCategory::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully!',
            'category' => $category
        ], 201);
    }
}