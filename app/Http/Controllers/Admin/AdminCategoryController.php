<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $type = $request->input('type', '');

        if ($request->ajax()) {
            $categories = Category::query()
                ->when($search, function ($q, $search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                ->when($type, function ($q, $type) {
                    $q->where('type', $type);
                })
                ->latest()
                ->get();

            return view('admin.category.partials.table', compact('categories'));
        }

        $eventCategories = Category::where('type', 'event')
            ->when($search, function ($q, $search) {
                $q->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        $scheduleCategories = Category::where('type', 'schedule')
            ->when($search, function ($q, $search) {
                $q->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        return view('admin.category.index', compact('eventCategories', 'scheduleCategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:event,schedule',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        Category::create($validated);

        if ($request->ajax()) {
            return response()->json(['message' => 'Kategori berhasil ditambahkan']);
        }

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:event,schedule',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        if ($request->ajax()) {
            return response()->json(['message' => 'Kategori berhasil diupdate']);
        }

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diupdate');
    }

    public function edit(Category $category)
    {
        return response()->json($category);
    }

    public function destroy(Request $request, Category $category)
    {
        if ($category->events()->count() > 0 || $category->schedules()->count() > 0) {
            $msg = 'Kategori tidak bisa dihapus karena masih digunakan oleh data lain';
            if ($request->ajax()) {
                return response()->json(['message' => $msg], 422);
            }
            return redirect()->route('admin.categories.index')->with('error', $msg);
        }

        $category->delete();

        if ($request->ajax()) {
            return response()->json(['message' => 'Kategori berhasil dihapus']);
        }

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus');
    }
}
