<?php

namespace Database\Seeders;

use App\Models\GeneralWorship;
use Illuminate\Database\Seeder;

class GeneralWorshipSeeder extends Seeder
{
    public function run(): void
    {
        GeneralWorship::truncate();

        GeneralWorship::create([
            'session' => 'morning',
            'time' => '08.00 WIB',
            'location' => 'Gedung Gereja GBKP Bandar Lampung',
            'preacher' => 'Pdt. Andreas Pranata Meliala, M.Th',
            'liturgist' => 'Pdt. Dedy K. Sinulingga',
            'coordinator' => 'Dk. Diana Nona Br. Sembiring',
            'prayer_leader' => 'Pt. Gunawan Barus',
            'announcement' => 'Dk. Mariatim Br. Kaban',
            'offering' => 'Pt. Gelora Sinuhaji',
            'collector_1' => 'Pt. Hiskia Juana Ginting',
            'collector_2' => 'Dk. Misnawati Br. Sebayang',
            'greeter_1' => 'Dk. Patuan Situmorang',
            'greeter_2' => 'Dk. Dwija Ginting',
            'organist_1' => 'Anselmus Libreya Sinulingga',
            'organist_2' => 'Dk. Margaretha Sagala',
            'song_leader_1' => 'Liwarni Sinamora',
            'song_leader_2' => 'Mispa Br. Surbakti',
            'worship_leader' => '-',
            'multimedia' => 'Claresta Br. Ginting',
            'praise_offering' => 'Getsemani',
        ]);

        GeneralWorship::create([
            'session' => 'afternoon',
            'time' => '17.00 WIB',
            'location' => 'Gedung Gereja GBKP Bandar Lampung',
            'preacher' => 'Pdt. Edy Surbakti, S.Th',
            'liturgist' => 'Pt. Normal Ginting',
            'coordinator' => 'Pt. Fransta Kacaribu',
            'prayer_leader' => 'Dk. Riza Surbakti',
            'announcement' => 'Dk. Herlan Tarigan',
            'offering' => 'Dk. Antony Tarigan',
            'collector_1' => 'Dk. Riston Surbakti',
            'collector_2' => 'Dk. Andelta Sinuraya',
            'greeter_1' => 'Pt. Masdi Sitepu',
            'greeter_2' => 'Pt. Em. Gideon Perangin-angin',
            'organist_1' => 'Pt. Bartolomeus Sinuhaji',
            'organist_2' => 'Pt. Yetty Br. Tobing',
            'song_leader_1' => 'Angelica Br. Surbakti',
            'song_leader_2' => 'Viko Alexandre Sebayang',
            'worship_leader' => 'Nora Nd. Bara Sembiring',
            'multimedia' => 'Vina Br. Perangin-angin',
            'praise_offering' => '-',
        ]);
    }
}
