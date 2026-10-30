<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reflection;
use Illuminate\Http\Request;

class AdminReflectionController extends Controller
{
    /** Tipe reflection yang dikelola controller ini. */
    protected string $type = Reflection::TYPE_RENUNGAN;

    /** Prefix nama route admin, mis. "admin.reflections". */
    protected string $routePrefix = 'admin.reflections';

    /** Label tunggal, mis. "Renungan". */
    protected string $label = 'Renungan';

    /** Label jamak / nama halaman, mis. "Renungan Harian". */
    protected string $labelPlural = 'Renungan Harian';

    /** Nama route publik untuk melihat detail. */
    protected string $publicDetailRoute = 'client.reflections.detail';

    public function index(Request $request)
    {
        $perPage = (int) $request->input('per_page', 10);
        $search = $request->input('search', '');

        $reflections = Reflection::query()
            ->ofType($this->type)
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

        $meta = $this->viewMeta();

        if ($request->ajax()) {
            return view('admin.reflection.partials.table', compact('reflections', 'meta'));
        }

        return view('admin.reflection.index', compact('reflections', 'meta'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());
        $validated['type'] = $this->type;

        unset($validated['image']);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('reflections', 'public');
        }

        Reflection::create($validated);

        $message = "{$this->label} berhasil ditambahkan";

        if ($request->ajax()) {
            return response()->json(['message' => $message]);
        }

        return redirect()->route($this->routePrefix.'.index')->with('success', $message);
    }

    public function update(Request $request, Reflection $reflection)
    {
        $this->ensureType($reflection);

        $validated = $request->validate($this->rules());

        if ($request->hasFile('image')) {
            $reflection->deleteImageFromDisk();
            $validated['image'] = $request->file('image')->store('reflections', 'public');
        }

        unset($validated['image']);
        $reflection->update($validated);

        $message = "{$this->label} berhasil diupdate";

        if ($request->ajax()) {
            return response()->json(['message' => $message]);
        }

        return redirect()->route($this->routePrefix.'.index')->with('success', $message);
    }

    public function edit(Reflection $reflection)
    {
        $this->ensureType($reflection);

        return response()->json($reflection);
    }

    public function destroy(Request $request, Reflection $reflection)
    {
        $this->ensureType($reflection);

        $reflection->deleteImageFromDisk();
        $reflection->delete();

        $message = "{$this->label} berhasil dihapus";

        if ($request->ajax()) {
            return response()->json(['message' => $message]);
        }

        return redirect()->route($this->routePrefix.'.index')->with('success', $message);
    }

    private function ensureType(Reflection $reflection): void
    {
        abort_unless($reflection->type === $this->type, 404);
    }

    private function viewMeta(): array
    {
        return [
            'routePrefix' => $this->routePrefix,
            'label' => $this->label,
            'labelPlural' => $this->labelPlural,
            'publicDetailRoute' => $this->publicDetailRoute,
        ];
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
