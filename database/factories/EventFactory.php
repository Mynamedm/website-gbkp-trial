<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        $title = fake()->sentence(4);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->paragraph(),
            'content' => fake()->paragraphs(3, true),
            'date' => fake()->dateTimeBetween('-1 month', '+3 months'),
            'time_start' => '08:00',
            'time_end' => '10:00',
            'location' => 'GBKP Bandar Lampung',
            'organized_by' => null,
            'category' => fake()->randomElement(['Ibadah', 'Pernikahan', 'Baptisan', 'Persekutuan', 'Pelayanan']),
            'quote' => fake()->sentence(),
            'quote_source' => 'Matius ' . fake()->numberBetween(1, 28) . ':' . fake()->numberBetween(1, 40),
            'image' => null,
            'status' => 'published',
        ];
    }
}
