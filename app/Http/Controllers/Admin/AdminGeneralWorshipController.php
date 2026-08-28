<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralWorship;
use Illuminate\Http\Request;

class AdminGeneralWorshipController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->input('per_page', 10);
        $search = $request->input('search', '');

        $worships = GeneralWorship::latest('id')
            ->when($search, function ($q, $search) {
                $q->where('preacher', 'like', "%{$search}%")
                  ->orWhere('liturgist', 'like', "%{$search}%")
                  ->orWhere('coordinator', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('time', 'like', "%{$search}%");
            })
            ->paginate($perPage);

        if ($request->ajax()) {
            return view('admin.worship.partials.table', compact('worships'));
        }

        return view('admin.worship.index', compact('worships'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        GeneralWorship::create($validated);

        if ($request->ajax()) {
            return response()->json(['message' => 'Jadwal ibadah umum berhasil ditambahkan']);
        }

        return redirect()->route('admin.worships.index')->with('success', 'Jadwal ibadah umum berhasil ditambahkan');
    }

    public function update(Request $request, GeneralWorship $worship)
    {
        $validated = $request->validate($this->rules());

        $worship->update($validated);

        if ($request->ajax()) {
            return response()->json(['message' => 'Jadwal ibadah umum berhasil diupdate']);
        }

        return redirect()->route('admin.worships.index')->with('success', 'Jadwal ibadah umum berhasil diupdate');
    }

    public function edit(GeneralWorship $worship)
    {
        return response()->json($worship);
    }

    public function show(GeneralWorship $worship)
    {
        return response()->json($worship);
    }

    public function destroy(Request $request, GeneralWorship $worship)
    {
        $worship->delete();

        if ($request->ajax()) {
            return response()->json(['message' => 'Jadwal ibadah umum berhasil dihapus']);
        }

        return redirect()->route('admin.worships.index')->with('success', 'Jadwal ibadah umum berhasil dihapus');
    }

    private function rules(): array
    {
        return [
            'session' => 'required|in:morning,afternoon',
            'time' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'preacher' => 'nullable|string|max:255',
            'liturgist' => 'nullable|string|max:255',
            'coordinator' => 'nullable|string|max:255',
            'prayer_leader' => 'nullable|string|max:255',
            'announcement' => 'nullable|string|max:255',
            'offering' => 'nullable|string|max:255',
            'collector_1' => 'nullable|string|max:255',
            'collector_2' => 'nullable|string|max:255',
            'greeter_1' => 'nullable|string|max:255',
            'greeter_2' => 'nullable|string|max:255',
            'organist_1' => 'nullable|string|max:255',
            'organist_2' => 'nullable|string|max:255',
            'song_leader_1' => 'nullable|string|max:255',
            'song_leader_2' => 'nullable|string|max:255',
            'worship_leader' => 'nullable|string|max:255',
            'multimedia' => 'nullable|string|max:255',
            'praise_offering' => 'nullable|string|max:255',
        ];
    }
}
