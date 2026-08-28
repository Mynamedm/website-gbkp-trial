<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminScheduleController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->input('per_page', 10);
        $search = $request->input('search', '');

        $schedules = Schedule::with('categoryRel')->latest('date')
            ->when($search, function ($q, $search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('sector', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('host', 'like', "%{$search}%");
            })
            ->paginate($perPage);

        if ($request->ajax()) {
            return view('admin.schedule.partials.table', compact('schedules'));
        }

        $categories = Category::where('type', 'schedule')->orderBy('name')->get();

        return view('admin.schedule.index', compact('schedules', 'categories'));
    }

    public function kategorial(Request $request)
    {
        $perPage = (int) $request->input('per_page', 10);
        $search = $request->input('search', '');
        $categoryId = $request->input('category_id', '');
        $sector = $request->input('sector', '');

        $schedules = Schedule::with('categoryRel')
            ->when($categoryId, function ($q, $categoryId) {
                $q->where('category_id', $categoryId);
            })
            ->when($sector, function ($q, $sector) {
                $q->where('sector', $sector);
            })
            ->latest('date')
            ->when($search, function ($q, $search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('sector', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('host', 'like', "%{$search}%");
            })
            ->paginate($perPage);

        if ($request->ajax()) {
            return view('admin.schedule.partials.table', compact('schedules'));
        }

        $categories = Category::where('type', 'schedule')->orderBy('name')->get();

        return view('admin.schedule.kategorial', compact('schedules', 'categories', 'categoryId', 'sector'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'sector' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'host' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'date' => 'required|date',
            'time' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        if (!empty($validated['category_id'])) {
            $cat = Category::find($validated['category_id']);
            $validated['category'] = $cat?->name;
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('schedules', 'public');
        }

        unset($validated['image']);
        Schedule::create($validated);

        if ($request->ajax()) {
            return response()->json(['message' => 'Jadwal berhasil ditambahkan']);
        }

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'sector' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'host' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'date' => 'required|date',
            'time' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        if (!empty($validated['category_id'])) {
            $cat = Category::find($validated['category_id']);
            $validated['category'] = $cat?->name;
        } else {
            if (empty($validated['category'])) {
                $validated['category'] = null;
            }
        }

        if ($request->hasFile('image')) {
            if ($schedule->image) {
                Storage::disk('public')->delete($schedule->image);
            }
            $validated['image'] = $request->file('image')->store('schedules', 'public');
        }

        unset($validated['image']);
        $schedule->update($validated);

        if ($request->ajax()) {
            return response()->json(['message' => 'Jadwal berhasil diupdate']);
        }

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil diupdate');
    }

    public function edit(Schedule $schedule)
    {
        return response()->json($schedule);
    }

    public function destroy(Request $request, Schedule $schedule)
    {
        if ($schedule->image) {
            Storage::disk('public')->delete($schedule->image);
        }
        $schedule->delete();

        if ($request->ajax()) {
            return response()->json(['message' => 'Jadwal berhasil dihapus']);
        }

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil dihapus');
    }
}
