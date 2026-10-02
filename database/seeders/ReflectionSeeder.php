<?php

namespace Database\Seeders;

use App\Models\Reflection;
use Illuminate\Database\Seeder;

class ReflectionSeeder extends Seeder
{
    public function run(): void
    {
        $reflections = [
            [
                'title' => 'Tenanglah, Jangan Takut',
                'date' => '2026-08-09',
                'church_day' => 'Minggu Advent',
                'theme' => 'Tuhan Menemanimu di Perjalanan',
                'bible_verse' => 'Matius 14 : 22 - 33',
                'bible_translation' => 'Terjemahan Baru',
                'excerpt' => 'Malam itu murid-murid masih berada di tengah laut. Gelombang menghempas perahu mereka dan angin bertiup kencang, sehingga mereka merasa takut.',
                'body' => "Malam itu murid-murid masih berada di tengah laut. Gelombang menghempas perahu mereka dan angin bertiup kencang, sehingga mereka merasa takut.\n\nMereka berseru meminta Tuhan datang. Yesus pun naik ke perahu dan memberi tahu mereka: Tenanglah, jangan takut. Setelah itu angin langsung teduh.\n\nPengajaran hari ini: Tuhan tidak meninggalkan kita di tengah kesulitan. Dia selalu datang menemani kita.",
                'status' => 'active',
            ],
            [
                'title' => 'Maria Bersorak di dalam Hatinya',
                'date' => '2026-08-02',
                'church_day' => 'Minggu I Prapenumasa Pentakosta',
                'theme' => 'Harap atas Ciptaan yang Baru',
                'bible_verse' => 'Lukas 1 : 46 - 55',
                'bible_translation' => 'Terjemahan Baru',
                'excerpt' => 'Maria bersorak-sorak di dalam hatinya akan TUHAN, sebab Dia telah melakukan perkara-perkara besar.',
                'body' => "Maria bersorak-sorak di dalam hatinya akan TUHAN, sebab Dia telah melakukan perkara-perkara besar.\n\nOrang yang berkuasa dan yang merendahkan diri dijadikan orang yang besar. Maria tidak menyanjung diri sendiri, tetapi menyanjung kemurahan Allah.\n\nPengajaran hari ini: Allah tidak pernah menyingkirkan orang yang rendah hati dan mengangkat mereka yang percaya kepada-Nya.",
                'status' => 'active',
            ],
            [
                'title' => 'Damai Sejahtera di dalam Kristus',
                'date' => '2026-07-26',
                'church_day' => 'Minggu VI Waktu Biasa',
                'theme' => 'Damai yang Melebihi Pemahaman',
                'bible_verse' => 'Yohanes 14 : 27',
                'bible_translation' => 'Terjemahan Baru',
                'excerpt' => 'Yesus memberi damai sejahtera kepada murid-murid-Nya. Damai itu bukan seperti damai yang diberikan oleh dunia.',
                'body' => "Yesus memberi damai sejahtera kepada murid-murid-Nya. Damai itu bukan seperti damai yang diberikan oleh dunia, karena damai dunia tidak bertahan lama.\n\nKasih Allah telah dicurahkan ke dalam hati kita oleh Roh Kudus. Karena itu hati yang sudah dikasihi Allah dapat tetap tenang dalam segala situasi.\n\nPengajaran hari ini: janganlah kita cemas dalam keadaan apa pun, karena damai Kristus menjaga hati dan pikiran kita.",
                'status' => 'active',
            ],
        ];

        foreach ($reflections as $reflection) {
            Reflection::updateOrCreate(
                ['title' => $reflection['title'], 'date' => $reflection['date']],
                $reflection,
            );
        }
    }
}