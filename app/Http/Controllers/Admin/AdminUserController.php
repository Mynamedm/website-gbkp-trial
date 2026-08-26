<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->input('per_page', 10);
        $search = $request->input('search', '');

        $users = User::with('roles')
            ->when($search, function ($q, $search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate($perPage);

        if ($request->ajax()) {
            return view('admin.user.partials.table', compact('users'));
        }

        return view('admin.user.index', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->assignRole($validated['role']);

        if ($request->ajax()) {
            return response()->json(['message' => 'User berhasil ditambahkan']);
        }

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:users,email,' . $user->id,
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|exists:roles,name',
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);
        $user->syncRoles($validated['role']);

        if ($request->ajax()) {
            return response()->json(['message' => 'User berhasil diupdate']);
        }

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diupdate');
    }

    public function edit(User $user)
    {
        return response()->json($user->load('roles'));
    }

    public function destroy(Request $request, User $user)
    {
        if ($user->id === auth()->id()) {
            if ($request->ajax()) {
                return response()->json(['message' => 'Tidak dapat menghapus akun sendiri'], 422);
            }
            return redirect()->route('admin.users.index')->with('error', 'Tidak dapat menghapus akun sendiri');
        }

        $user->delete();

        if ($request->ajax()) {
            return response()->json(['message' => 'User berhasil dihapus']);
        }

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus');
    }
}
