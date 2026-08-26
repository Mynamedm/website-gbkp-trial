<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $schedules = [
            ['title' => 'Ibadah Moria', 'sector' => 'Sektor Yerikho', 'location' => 'Jambur Cowir Metua', 'host' => 'Nd. Ari Ginting', 'date' => '2026-08-12', 'time' => '17:00 WIB', 'description' => 'Jadwal ibadah kaum ibu', 'status' => 'active'],
            ['title' => 'Ibadah Moria', 'sector' => 'Sektor Nazareth', 'location' => 'Jambur Cowir Metua', 'host' => 'Nd. Ari Ginting', 'date' => '2026-08-12', 'time' => '17:00 WIB', 'description' => 'Jadwal ibadah kaum ibu', 'status' => 'active'],
            ['title' => 'Ibadah Moria', 'sector' => 'Sektor Tiberias', 'location' => 'Jambur Cowir Metua', 'host' => 'Nd. Ari Ginting', 'date' => '2026-08-12', 'time' => '17:00 WIB', 'description' => 'Jadwal ibadah kaum ibu', 'status' => 'active'],
            ['title' => 'Ibadah Minggu', 'sector' => null, 'location' => 'GBKP Bandar Lampung', 'host' => null, 'date' => '2026-08-16', 'time' => '09:00 WIB', 'description' => 'Ibadah minggu rutin', 'status' => 'active'],
            ['title' => 'Persekutuan Pemuda', 'sector' => null, 'location' => 'GBKP Bandar Lampung', 'host' => null, 'date' => '2026-08-20', 'time' => '18:30 WIB', 'description' => 'Persekutuan pemuda mingguan', 'status' => 'active'],
        ];

        foreach ($schedules as $schedule) {
            Schedule::create($schedule);
        }
    }
}
