<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reflection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminReflectionController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->input('per_page', 10);
        $search = $request->input('search', '');

        $reflections = Reflection::query()
            ->latestFirst()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('theme', 'like', "%{$search}%")
                      ->orWhere('bible_verse', 'like', "%{$search}%");
                });
            })
            ->paginate($perPage)
            ->withQueryString();

        if ($request->ajax()) {
            return view('admin.reflection.partials.table', compact('reflections'));
        }

        return view('admin.reflection.index', compact('reflections'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('reflections', 'public');
        }

        unset($validated['image']);
        Reflection::create($validated);

        if ($request->ajax()) {
            return response()->json(['message' => 'Renungan berhasil ditambahkan']);
        }

        return redirect()->route('admin.reflections.index')->with('success', 'Renungan berhasil ditambahkan');
    }

    public function update(Request $request, Reflection $reflection)
    {
        $validated = $request->validate($this->rules());

        if ($request->hasFile('image')) {
            $reflection->deleteImageFromDisk();
            $validated['image'] = $request->file('image')->store('reflections', 'public');
        }

        unset($validated['image']);
        $reflection->update($validated);

        if ($request->ajax()) {
            return response()->json(['message' => 'Renungan berhasil diupdate']);
        }

        return redirect()->route('admin.reflections.index')->with('success', 'Renungan berhasil diupdate');
    }

    public function edit(Reflection $reflection)
    {
        return response()->json($reflection);
    }

    public function destroy(Request $request, Reflection $reflection)
    {
        $reflection->deleteImageFromDisk();
        $reflection->delete();

        if ($request->ajax()) {
            return response()->json(['message' => 'Renungan berhasil dihapus']);
        }

        return redirect()->route('admin.reflections.index')->with('success', 'Renungan berhasil dihapus');
    }

    private function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'church_day' => 'nullable|string|max:255',
            'theme' => 'nullable|string|max:255',
            'bible_verse' => 'nullable|string|max:255',
            'bible_translation' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string|max:1000',
            'body' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:active,inactive',
        ];
    }
}