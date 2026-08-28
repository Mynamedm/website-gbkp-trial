<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminAnnouncementController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->input('per_page', 10);
        $search = $request->input('search', '');

        $announcements = Announcement::latest('date')
            ->when($search, function ($q, $search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('theme', 'like', "%{$search}%")
                  ->orWhere('bible_verse', 'like', "%{$search}%");
            })
            ->paginate($perPage)
            ->withQueryString();

        if ($request->ajax()) {
            return view('admin.announcement.partials.table', compact('announcements'));
        }

        return view('admin.announcement.index', compact('announcements'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'theme' => 'nullable|string|max:255',
            'bible_verse' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf|max:10240',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('file')) {
            $validated['file_path'] = $request->file('file')->store('announcements', 'public');
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('announcements', 'public');
        }

        unset($validated['file']);
        unset($validated['image']);
        Announcement::create($validated);

        if ($request->ajax()) {
            return response()->json(['message' => 'Warta berhasil ditambahkan']);
        }

        return redirect()->route('admin.announcements.index')->with('success', 'Warta berhasil ditambahkan');
    }

    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'theme' => 'nullable|string|max:255',
            'bible_verse' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf|max:10240',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('file')) {
            if ($announcement->file_path) {
                Storage::disk('public')->delete($announcement->file_path);
            }
            $validated['file_path'] = $request->file('file')->store('announcements', 'public');
        }

        if ($request->hasFile('image')) {
            if ($announcement->image) {
                Storage::disk('public')->delete($announcement->image);
            }
            $validated['image'] = $request->file('image')->store('announcements', 'public');
        }

        unset($validated['file']);
        unset($validated['image']);
        $announcement->update($validated);

        if ($request->ajax()) {
            return response()->json(['message' => 'Warta berhasil diupdate']);
        }

        return redirect()->route('admin.announcements.index')->with('success', 'Warta berhasil diupdate');
    }

    public function edit(Announcement $announcement)
    {
        return response()->json($announcement);
    }

    public function destroy(Request $request, Announcement $announcement)
    {
        if ($announcement->file_path) {
            Storage::disk('public')->delete($announcement->file_path);
        }
        if ($announcement->image) {
            Storage::disk('public')->delete($announcement->image);
        }
        $announcement->delete();

        if ($request->ajax()) {
            return response()->json(['message' => 'Warta berhasil dihapus']);
        }

        return redirect()->route('admin.announcements.index')->with('success', 'Warta berhasil dihapus');
    }
}
