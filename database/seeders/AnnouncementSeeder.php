<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        $announcements = [
            ['title' => 'Warta Jemaat 02 Agustus 2026', 'date' => '2026-08-02', 'theme' => 'Tuhan Gembalaku', 'bible_verse' => 'Mazmur 23:1-3', 'description' => 'Warta jemaat minggu Advent II', 'status' => 'active'],
            ['title' => 'Warta Jemaat 09 Agustus 2026', 'date' => '2026-08-09', 'theme' => 'Tuhan Gembalaku', 'bible_verse' => 'Mazmur 23:1-3', 'description' => 'Warta jemaat minggu Advent II', 'status' => 'active'],
            ['title' => 'Warta Jemaat 16 Agustus 2026', 'date' => '2026-08-16', 'theme' => 'Tuhan Gembalaku', 'bible_verse' => 'Mazmur 23:1-3', 'description' => 'Warta jemaat minggu Advent II', 'status' => 'active'],
            ['title' => 'Warta Jemaat 23 Agustus 2026', 'date' => '2026-08-23', 'theme' => 'Tuhan Gembalaku', 'bible_verse' => 'Mazmur 23:1-3', 'description' => 'Warta jemaat minggu Advent II', 'status' => 'active'],
        ];

        foreach ($announcements as $announcement) {
            Announcement::create($announcement);
        }
    }
}
