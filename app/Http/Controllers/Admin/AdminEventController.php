<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminEventController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->input('per_page', 10);
        $search = $request->input('search', '');

        $events = Event::with('categoryRel')->latest('date')
            ->when($search, function ($q, $search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            })
            ->paginate($perPage);

        if ($request->ajax()) {
            return view('admin.event.partials.table', compact('events'));
        }

        $categories = Category::where('type', 'event')->orderBy('name')->get();

        return view('admin.event.index', compact('events', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'date' => 'required|date',
            'time_start' => 'nullable|string|max:50',
            'time_end' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'organized_by' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'quote' => 'nullable|string',
            'quote_source' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:draft,published,archived',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if (!empty($validated['category_id'])) {
            $cat = Category::find($validated['category_id']);
            $validated['category'] = $cat?->name;
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        unset($validated['image']);
        Event::create($validated);

        if ($request->ajax()) {
            return response()->json(['message' => 'Event berhasil ditambahkan']);
        }

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil ditambahkan');
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'date' => 'required|date',
            'time_start' => 'nullable|string|max:50',
            'time_end' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'organized_by' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'quote' => 'nullable|string',
            'quote_source' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:draft,published,archived',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if (!empty($validated['category_id'])) {
            $cat = Category::find($validated['category_id']);
            $validated['category'] = $cat?->name;
        } else {
            $validated['category'] = null;
        }

        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        unset($validated['image']);
        $event->update($validated);

        if ($request->ajax()) {
            return response()->json(['message' => 'Event berhasil diupdate']);
        }

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diupdate');
    }

    public function edit(Event $event)
    {
        return response()->json($event);
    }

    public function destroy(Request $request, Event $event)
    {
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }
        $event->delete();

        if ($request->ajax()) {
            return response()->json(['message' => 'Event berhasil dihapus']);
        }

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus');
    }
}
