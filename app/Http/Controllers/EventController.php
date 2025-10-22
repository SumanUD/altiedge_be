<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    // AdminLTE: List all events
    public function index()
    {
        $events = Event::latest()->get();
        return view('admin.events.index', compact('events'));
    }

    // Show create form
    public function create()
    {
        return view('admin.events.create');
    }

    // Store new event
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'sub_heading' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'gallery_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $images = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $images[] = $file->store('events', 'public');
            }
        }
        $validated['gallery_images'] = $images;

        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    // Show edit form
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    // Update event
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'sub_heading' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'gallery_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $images = $event->gallery_images ?? [];

        if ($request->hasFile('gallery_images')) {
            // Optionally delete old images
            foreach ($request->file('gallery_images') as $file) {
                $images[] = $file->store('events', 'public');
            }
        }

        $validated['gallery_images'] = $images;

        $event->update($validated);

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    // Delete event
    public function destroy(Event $event)
    {
        // Delete images from storage
        if ($event->gallery_images) {
            foreach ($event->gallery_images as $img) {
                Storage::disk('public')->delete($img);
            }
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }

    // API endpoints for Next.js frontend
    public function apiIndex()
    {
        $events = Event::latest()->get();
        return response()->json($events);
    }

    public function apiShow($id)
    {
        $event = Event::findOrFail($id);
        return response()->json($event);
    }
}
