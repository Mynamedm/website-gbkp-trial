<?php

namespace Database\Factories;

use App\Models\GeneralWorship;
use Illuminate\Database\Eloquent\Factories\Factory;

class GeneralWorshipFactory extends Factory
{
    protected $model = GeneralWorship::class;

    public function definition(): array
    {
        return [
            'session' => fake()->randomElement(['morning', 'afternoon']),
            'time' => fake()->randomElement(['08.00 WIB', '17.00 WIB']),
            'location' => 'Gedung Gereja GBKP Bandar Lampung',
            'preacher' => fake()->name(),
            'liturgist' => fake()->name(),
            'coordinator' => fake()->name(),
            'prayer_leader' => fake()->name(),
            'announcement' => fake()->name(),
            'offering' => fake()->name(),
            'collector_1' => fake()->name(),
            'collector_2' => fake()->name(),
            'greeter_1' => fake()->name(),
            'greeter_2' => fake()->name(),
            'organist_1' => fake()->name(),
            'organist_2' => fake()->name(),
            'song_leader_1' => fake()->name(),
            'song_leader_2' => fake()->name(),
            'worship_leader' => fake()->name(),
            'multimedia' => fake()->name(),
            'praise_offering' => fake()->word(),
        ];
    }
}
