<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@gbkp.id')->first();

        $catIds = [
            'marturia' => Category::where('slug', 'marturia')->where('type', 'event')->value('id'),
            'diakonia' => Category::where('slug', 'diakonia')->where('type', 'event')->value('id'),
            'koinonia' => Category::where('slug', 'koinonia')->where('type', 'event')->value('id'),
            'keuangan' => Category::where('slug', 'keuangan')->where('type', 'event')->value('id'),
        ];

        $events = [
            [
                'title' => 'Pemberkatan Pernikahan Demo & Nina',
                'slug' => 'pemberkatan-pernikahan-demo-nina',
                'description' => 'Telah dilaksanakan pemberkatan pernikahan Demo dan Nina Tn Ginting pada hari Selasa, 05 Juli 2026 di GBKP Bandar Lampung. Kegiatan berlangsung dengan penuh sukacita.',
                'content' => 'Kegiatan berlangsung dengan penuh sukacita. Kiranya Tuhan memberkati keluarga baru ini di dalam kasih dan damai sejahtera.',
                'date' => '2026-07-05',
                'time_start' => '10:00',
                'time_end' => 'Selesai',
                'location' => 'GBKP Bandar Lampung',
                'organized_by' => $admin?->id,
                'category' => 'marturia',
                'category_id' => $catIds['marturia'],
                'quote' => 'Demikianlah mereka bukan lagi dua, melainkan satu. Karena itu, apa yang telah dipersatukan Allah, tidak boleh diceraikan manusia.',
                'quote_source' => 'Matius 19:6',
                'status' => 'published',
            ],
            [
                'title' => 'Ibadah Minggu Advent I',
                'slug' => 'ibadah-minggu-advent-i',
                'description' => 'Ibadah Minggu Advent I bersama seluruh jemaat GBKP Bandar Lampung.',
                'content' => 'Ibadah Minggu Advent I dengan tema Penantian akan kedatangan Tuhan Yesus Kristus.',
                'date' => '2026-09-27',
                'time_start' => '08:00',
                'time_end' => '10:00',
                'location' => 'GBKP Bandar Lampung',
                'organized_by' => $admin?->id,
                'category' => 'marturia',
                'category_id' => $catIds['marturia'],
                'quote' => 'Karena itu, kamu harus siap sedia juga, karena Anak Manusia datang pada saat yang tidak kamu duga.',
                'quote_source' => 'Matius 24:44',
                'status' => 'published',
            ],
            [
                'title' => 'Kegiatan PERMATA Oktober',
                'slug' => 'kegiatan-permata-oktober',
                'description' => 'Persekutuan dan pelayanan pemuda GBKP Bandar Lampung.',
                'content' => 'Kegiatan PERMATA bulan Oktober dengan berbagai acara persekutuan dan pelayanan pemuda.',
                'date' => '2026-10-05',
                'time_start' => '14:00',
                'time_end' => '16:00',
                'location' => 'GBKP Bandar Lampung',
                'organized_by' => $admin?->id,
                'category' => 'koinonia',
                'category_id' => $catIds['koinonia'],
                'quote' => 'Janganlah kamu hendak berlaku lemah lembut, tetapi marilah berlomba di dalam perlombaan iman.',
                'quote_source' => 'Ibrani 12:1',
                'status' => 'published',
            ],
            [
                'title' => 'Baptisan Air',
                'slug' => 'baptisan-air',
                'description' => 'Pelayanan baptisan air bagi jemaat yang telah siap.',
                'content' => 'Baptisan air bagi jemaat yang telah mengikuti katekisasi dan menyatakan iman kepada Tuhan Yesus Kristus.',
                'date' => '2026-11-15',
                'time_start' => '09:00',
                'time_end' => '11:00',
                'location' => 'GBKP Bandar Lampung',
                'organized_by' => $admin?->id,
                'category' => 'marturia',
                'category_id' => $catIds['marturia'],
                'quote' => 'Karena itu, pergilah, jadikanlah murid-murid dari segala bangsa, membaptislah mereka dalam nama Bapa dan Anak dan Roh Kudus.',
                'quote_source' => 'Matius 28:19',
                'status' => 'published',
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
