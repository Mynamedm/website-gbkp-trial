<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private const NEW_CATEGORIES = [
        'marturia' => 'bg-sky-100 text-sky-700',
        'diakonia' => 'bg-amber-100 text-amber-700',
        'koinonia' => 'bg-emerald-100 text-emerald-700',
        'keuangan' => 'bg-indigo-100 text-indigo-700',
    ];

    private const LEGACY_MAP = [
        'Pernikahan' => 'marturia',
        'Ibadah' => 'marturia',
        'Baptisan' => 'marturia',
        'Kajian' => 'marturia',
        'Retreat' => 'koinonia',
        'Persekutuan' => 'koinonia',
        'Pemuda' => 'koinonia',
        'Lansia' => 'koinonia',
        'Perayaan' => 'koinonia',
        'Bakti Sosial' => 'diakonia',
    ];

    public function up(): void
    {
        $ids = [];

        foreach (self::NEW_CATEGORIES as $slug => $color) {
            $cat = DB::table('categories')->where('slug', $slug)->where('type', 'event')->first();

            if (!$cat) {
                $id = DB::table('categories')->insertGetId([
                    'name' => $slug,
                    'slug' => $slug,
                    'type' => 'event',
                    'color' => $color,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                DB::table('categories')->where('id', $cat->id)->update([
                    'name' => $slug,
                    'color' => $color,
                    'updated_at' => now(),
                ]);
                $id = $cat->id;
            }

            $ids[$slug] = $id;
        }

        DB::table('events')
            ->whereIn('category', array_keys(self::LEGACY_MAP))
            ->orderBy('id')
            ->get()
            ->each(function ($event) use ($ids) {
                $newSlug = self::LEGACY_MAP[$event->category];
                DB::table('events')->where('id', $event->id)->update([
                    'category' => $newSlug,
                    'category_id' => $ids[$newSlug] ?? null,
                ]);
            });

        DB::table('categories')
            ->where('type', 'event')
            ->whereNotIn('slug', array_keys(self::NEW_CATEGORIES))
            ->delete();
    }

    public function down(): void
    {
        DB::table('categories')
            ->where('type', 'event')
            ->whereIn('slug', array_keys(self::NEW_CATEGORIES))
            ->delete();

        DB::table('events')->update(['category_id' => null]);
    }
};