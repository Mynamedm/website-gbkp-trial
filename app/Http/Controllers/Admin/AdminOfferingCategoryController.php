<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfferingCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminOfferingCategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $categories = OfferingCategory::query()
            ->when($search, function ($q, $search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('bank_name', 'like', "%{$search}%");
            })
            ->orderBy('sort_order')
            ->latest()
            ->get();

        if ($request->ajax()) {
            return view('admin.offering.partials.table', compact('categories'));
        }

        return view('admin.offering.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'bank_name' => 'nullable|string|max:255',
            'bank_account_number' => 'nullable|string|max:50',
            'bank_account_name' => 'nullable|string|max:255',
            'qris_image' => 'nullable|string|max:500',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        OfferingCategory::create($validated);

        if ($request->ajax()) {
            return response()->json(['message' => 'Kategori persembahan berhasil ditambahkan']);
        }

        return redirect()->route('admin.offering-categories.index')->with('success', 'Kategori persembahan berhasil ditambahkan');
    }

    public function update(Request $request, OfferingCategory $offeringCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'bank_name' => 'nullable|string|max:255',
            'bank_account_number' => 'nullable|string|max:50',
            'bank_account_name' => 'nullable|string|max:255',
            'qris_image' => 'nullable|string|max:500',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active');

        $offeringCategory->update($validated);

        if ($request->ajax()) {
            return response()->json(['message' => 'Kategori persembahan berhasil diupdate']);
        }

        return redirect()->route('admin.offering-categories.index')->with('success', 'Kategori persembahan berhasil diupdate');
    }

    public function edit(OfferingCategory $offeringCategory)
    {
        return response()->json($offeringCategory);
    }

    public function destroy(Request $request, OfferingCategory $offeringCategory)
    {
        $offeringCategory->delete();

        if ($request->ajax()) {
            return response()->json(['message' => 'Kategori persembahan berhasil dihapus']);
        }

        return redirect()->route('admin.offering-categories.index')->with('success', 'Kategori persembahan berhasil dihapus');
    }
}
