<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'marturia', 'slug' => 'marturia', 'type' => 'event', 'color' => 'bg-sky-100 text-sky-700'],
            ['name' => 'diakonia', 'slug' => 'diakonia', 'type' => 'event', 'color' => 'bg-amber-100 text-amber-700'],
            ['name' => 'koinonia', 'slug' => 'koinonia', 'type' => 'event', 'color' => 'bg-emerald-100 text-emerald-700'],
            ['name' => 'keuangan', 'slug' => 'keuangan', 'type' => 'event', 'color' => 'bg-indigo-100 text-indigo-700'],
        ];

        $scheduleCategories = [
            ['name' => 'Mamre', 'slug' => 'mamre', 'type' => 'schedule', 'color' => 'bg-blue-100 text-blue-700'],
            ['name' => 'Moria', 'slug' => 'moria', 'type' => 'schedule', 'color' => 'bg-pink-100 text-pink-700'],
            ['name' => 'PJJ', 'slug' => 'pjj', 'type' => 'schedule', 'color' => 'bg-teal-100 text-teal-700'],
            ['name' => 'Permata', 'slug' => 'permata', 'type' => 'schedule', 'color' => 'bg-violet-100 text-violet-700'],
            ['name' => 'KA-KR', 'slug' => 'kakr', 'type' => 'schedule', 'color' => 'bg-green-100 text-green-700'],
            ['name' => 'SAITUN', 'slug' => 'saitun', 'type' => 'schedule', 'color' => 'bg-amber-100 text-amber-700'],
            ['name' => 'NAOMI', 'slug' => 'naomi', 'type' => 'schedule', 'color' => 'bg-rose-100 text-rose-700'],
        ];

        foreach ($scheduleCategories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
