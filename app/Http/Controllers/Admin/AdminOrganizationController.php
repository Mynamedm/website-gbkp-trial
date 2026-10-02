<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrganizationMember;
use App\Models\OrganizationSetting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AdminOrganizationController extends Controller
{
    public function index(Request $request)
    {
        $settings = OrganizationSetting::current();
        $roots = OrganizationMember::tree();

        if ($request->ajax()) {
            return view('admin.organization.partials.chart', compact('roots'));
        }

        $members = OrganizationMember::query()
            ->orderBy('position')
            ->get(['id', 'parent_id', 'position', 'name', 'slug', 'sort_order', 'is_active']);

        $positionsById = $members->pluck('position', 'id');

        return view('admin.organization.index', compact('settings', 'roots', 'members', 'positionsById'));
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'periode' => 'nullable|string|max:255',
            'hero_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $settings = OrganizationSetting::current();

        if ($request->hasFile('hero_image')) {
            $settings->deleteHeroImageFromDisk();
            $validated['hero_image'] = $request->file('hero_image')->store('organization', 'public');
        } else {
            unset($validated['hero_image']);
        }

        $settings->update($validated);

        if ($request->ajax()) {
            return response()->json(['message' => 'Pengaturan struktur organisasi berhasil disimpan']);
        }

        return redirect()
            ->route('admin.organization.index')
            ->with('success', 'Pengaturan struktur organisasi berhasil disimpan');
    }

    public function store(Request $request)
    {
        $validated = $this->validateMember($request);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('organization/members', 'public');
        } else {
            unset($validated['photo']);
        }

        OrganizationMember::create($validated);

        if ($request->ajax()) {
            return response()->json(['message' => 'Jabatan berhasil ditambahkan']);
        }

        return redirect()
            ->route('admin.organization.index')
            ->with('success', 'Jabatan berhasil ditambahkan');
    }

    public function update(Request $request, OrganizationMember $organizationMember)
    {
        $validated = $this->validateMember($request, $organizationMember);

        if ($request->hasFile('photo')) {
            $organizationMember->deletePhotoFromDisk();
            $validated['photo'] = $request->file('photo')->store('organization/members', 'public');
        } elseif ($request->boolean('remove_photo')) {
            $organizationMember->deletePhotoFromDisk();
            $validated['photo'] = null;
        }

        $organizationMember->update($validated);

        if ($request->ajax()) {
            return response()->json(['message' => 'Jabatan berhasil diupdate']);
        }

        return redirect()
            ->route('admin.organization.index')
            ->with('success', 'Jabatan berhasil diupdate');
    }

    public function edit(OrganizationMember $organizationMember)
    {
        return response()->json($organizationMember);
    }

    public function destroy(Request $request, OrganizationMember $organizationMember)
    {
        if ($organizationMember->hasChildren()) {
            $msg = 'Jabatan tidak bisa dihapus karena masih punya bawahan. Hapus atau pindahkan bawahan terlebih dahulu.';

            if ($request->ajax()) {
                return response()->json(['message' => $msg], 422);
            }

            return redirect()->route('admin.organization.index')->with('error', $msg);
        }

        $organizationMember->deletePhotoFromDisk();
        $organizationMember->delete();

        if ($request->ajax()) {
            return response()->json(['message' => 'Jabatan berhasil dihapus']);
        }

        return redirect()->route('admin.organization.index')->with('success', 'Jabatan berhasil dihapus');
    }

    private function validateMember(Request $request, ?OrganizationMember $member = null): array
    {
        $validated = $request->validate([
            'parent_id' => ['nullable', Rule::exists('organization_members', 'id')],
            'position' => 'required|string|max:255',
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $parentId = $validated['parent_id'] ?? null;

        if ($member && filled($parentId)) {
            if ((int) $parentId === $member->id) {
                throw ValidationException::withMessages([
                    'parent_id' => 'Jabatan tidak bisa menjadi bawahan dirinya sendiri.',
                ]);
            }

            if (in_array((int) $parentId, $member->descendantIds(), true)) {
                throw ValidationException::withMessages([
                    'parent_id' => 'Jabatan tidak bisa dipindahkan ke bawah bawahannya sendiri.',
                ]);
            }
        }

        if (! $member) {
            $validated['slug'] = OrganizationMember::uniqueSlug($validated['position']);
        }

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }
}
