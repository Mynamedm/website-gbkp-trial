<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function index()
    {
        return view('client.index');
    }

    public function announcements()
    {
        return view('client.announcement.index');
    }

    public function scheduleWorship()
    {
        return view('client.schedule-worship.index');
    }

    public function scheduleWorshipUmum()
    {
        return view('client.schedule-worship.umum');
    }

    public function scheduleWorshipDetail($id)
    {
        $kategori = $this->getKategori($id);

        if (!$kategori) {
            abort(404);
        }

        $sektor = $this->getSektor($id);
        $hostLabel = $this->getHostLabel($id);
        $petugas = $this->getPetugas($id);
        $permataEvent = in_array($id, [5, 7, 8]) ? $this->getPermataEvent($id) : null;

        return view('client.schedule-worship.detail', compact('kategori', 'sektor', 'hostLabel', 'petugas', 'permataEvent'));
    }

    private function getKategori($id)
    {
        $kategori = [
            1 => [
                'breadcrumb' => 'Jadwal Ibadah Umum',
                'judul' => 'UMUM',
                'deskripsi' => 'Temukan jadwal ibadah sesuai kategori pelayanan di GBKP Bandar Lampung',
                'type' => 'umum',
                'section_title' => 'CARI JADWAL IBADAH UMUM',
                'section_subtitle' => '',
            ],
            2 => [
                'breadcrumb' => 'Moria',
                'judul' => 'MORIA',
                'deskripsi' => 'Jadwal ibadah kaum ibu di GBKP Bandar Lampung.',
                'type' => 'sektor',
                'section_title' => 'Sektor Pelayanan MORIA',
                'section_subtitle' => 'Jadwal ibadah berdasarkan sektor pelayanan MORIA GBKP Bandar Lampung',
            ],
            3 => [
                'breadcrumb' => 'Mamre',
                'judul' => 'MAMRE',
                'deskripsi' => 'Jadwal ibadah kaum ayah di GBKP Bandar Lampung.',
                'type' => 'sektor',
                'section_title' => 'Sektor Pelayanan MAMRE',
                'section_subtitle' => 'Jadwal ibadah berdasarkan sektor pelayanan MAMRE GBKP Bandar Lampung',
            ],
            4 => [
                'breadcrumb' => 'PJJ',
                'judul' => 'PJJ',
                'deskripsi' => 'Jadwal ibadah keluarga di GBKP Bandar Lampung.',
                'type' => 'sektor',
                'section_title' => 'Sektor Pelayanan PJJ',
                'section_subtitle' => 'Jadwal ibadah berdasarkan sektor pelayanan PJJ GBKP Bandar Lampung',
            ],
            5 => [
                'breadcrumb' => 'Permata',
                'judul' => 'PERMATA',
                'deskripsi' => 'Jadwal ibadah pemuda-pemudi di GBKP Bandar Lampung.',
                'type' => 'permata',
                'section_title' => 'Kegiatan PERMATA',
                'section_subtitle' => 'Jadwal kegiatan ibadah pemuda-pemudi GBKP Bandar Lampung',
            ],
            6 => [
                'breadcrumb' => 'KA-KR',
                'judul' => 'KA-KR',
                'deskripsi' => 'Jadwal ibadah anak - anak di GBKP Bandar Lampung.',
                'type' => 'kelas',
                'section_title' => 'KELAS KA-KR',
                'section_subtitle' => 'Jadwal ibadah berdasarkan kelas KA-KR GBKP Bandar Lampung',
            ],
            7 => [
                'breadcrumb' => 'Saitun',
                'judul' => 'SAITUN',
                'deskripsi' => 'Jadwal ibadah kaum lansia di GBKP Bandar Lampung.',
                'type' => 'permata',
                'section_title' => 'Kegiatan SAITUN',
                'section_subtitle' => 'Jadwal kegiatan ibadah kaum lansia GBKP Bandar Lampung',
            ],
            8 => [
                'breadcrumb' => 'Naomi',
                'judul' => 'NAOMI',
                'deskripsi' => 'Jadwal ibadah kaum janda di GBKP Bandar Lampung.',
                'type' => 'permata',
                'section_title' => 'Kegiatan NAOMI',
                'section_subtitle' => 'Jadwal kegiatan ibadah kaum janda GBKP Bandar Lampung',
            ],
        ];

        return $kategori[$id] ?? null;
    }

    private function getSektor($id)
    {
        $data = [
            1 => [
                'host_label' => 'Penanggung Jawab',
                'sektor' => [
                    ['nama' => 'SEKTOR YERIKHO', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR NAZARETH', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR TIBERIAS', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR GETSEMANI', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR JERUSALEM', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR KAPERNAUM', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR BETHANY', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                ],
            ],
            2 => [
                'host_label' => 'Nyonya Rumah',
                'sektor' => [
                    ['nama' => 'SEKTOR YERIKHO', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR NAZARETH', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR TIBERIAS', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR GETSEMANI', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR JERUSALEM', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR KAPERNAUM', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR BETHANY', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                ],
            ],
            3 => [
                'host_label' => 'Tuan Rumah',
                'sektor' => [
                    ['nama' => 'SEKTOR KANAAN', 'host' => 'Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR GALILEA', 'host' => 'Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR BETESDA', 'host' => 'Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR JERUSALEM', 'host' => 'Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR PHILIPI', 'host' => 'Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                ],
            ],
            4 => [
                'host_label' => 'Tuan Rumah',
                'sektor' => [
                    ['nama' => 'SEKTOR YERIKHO', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR NAZARETH', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR TIBERIAS', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR GETSEMANI', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR JERUSALEM', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR KAPERNAUM', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR BETHANY', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                ],
            ],
            5 => [
                'host_label' => 'Penanggung Jawab',
                'sektor' => [
                    ['nama' => 'SEKTOR YERIKHO', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR NAZARETH', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR TIBERIAS', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR GETSEMANI', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR JERUSALEM', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR KAPERNAUM', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR BETHANY', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                ],
            ],
            6 => [
                'host_label' => '',
                'sektor' => [
                    ['nama' => 'KELAS BATITA - BALITA', 'host' => '', 'lokasi' => 'PAUD', 'tanggal' => '', 'waktu' => '08 : 00 WIB'],
                    ['nama' => 'KELAS KECIL', 'host' => '', 'lokasi' => 'PAUD', 'tanggal' => '', 'waktu' => '08 : 00 WIB'],
                    ['nama' => 'KELAS TANGGUNG', 'host' => '', 'lokasi' => 'PAUD', 'tanggal' => '', 'waktu' => '08 : 00 WIB'],
                    ['nama' => 'KELAS REMAJA', 'host' => '', 'lokasi' => 'PAUD / RUANG KESEHATAN', 'tanggal' => '', 'waktu' => '08 : 00 WIB'],
                ],
            ],
            7 => [
                'host_label' => 'Penanggung Jawab',
                'sektor' => [
                    ['nama' => 'SEKTOR YERIKHO', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR NAZARETH', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR TIBERIAS', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR GETSEMANI', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR JERUSALEM', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR KAPERNAUM', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR BETHANY', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                ],
            ],
            8 => [
                'host_label' => 'Penanggung Jawab',
                'sektor' => [
                    ['nama' => 'SEKTOR YERIKHO', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR NAZARETH', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR TIBERIAS', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR GETSEMANI', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR JERUSALEM', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR KAPERNAUM', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                    ['nama' => 'SEKTOR BETHANY', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'tanggal' => 'Rabu, 12 Agustus 2026', 'waktu' => '17 : 00 WIB'],
                ],
            ],
        ];

        $data = $data[$id] ?? null;
        if (!$data) {
            return [];
        }

        return $data['sektor'];
    }

    private function getHostLabel($id)
    {
        $labels = [
            1 => 'Penanggung Jawab',
            2 => 'Nyonya Rumah',
            3 => 'Tuan Rumah',
            4 => 'Tuan Rumah',
            5 => 'Penanggung Jawab',
            6 => 'Penanggung Jawab',
            7 => 'Penanggung Jawab',
            8 => 'Penanggung Jawab',
        ];

        return $labels[$id] ?? 'Penanggung Jawab';
    }

    private function getPetugas($id)
    {
        if ($id !== 1) {
            return null;
        }

        return [
            'tanggal' => 'Minggu, 13 Desember 2026',
            'pagi' => [
                'jam' => '08.00 WIB',
                'lokasi' => 'Gedung Gereja GBKP Bandar Lampung',
                'petugas' => [
                    ['jabatan' => 'Pengkhotbah', 'nama' => 'Pdt. Andreas Pranata Meliala, M.Th'],
                    ['jabatan' => 'Liturgis', 'nama' => 'Pt. Dedy K. Sinulingga'],
                    ['jabatan' => 'Koordinator', 'nama' => 'Dk. Diana Nona Br. Sembiring'],
                    ['jabatan' => 'Pengantar Doa', 'nama' => 'Pt. Gunawan Barus'],
                    ['jabatan' => 'Kata Pengantar / Warta Jemaat', 'nama' => 'Dk. Mariatim Br. Kaban'],
                    ['jabatan' => 'Persembahan', 'nama' => 'Pt. Gelora Sinuhaji'],
                    ['jabatan' => 'Kolektan / Counter 1', 'nama' => 'Pt. Hiskia Juana Ginting'],
                    ['jabatan' => 'Kolektan / Counter 2', 'nama' => 'Dk. Misnawati Br. Sebayang'],
                    ['jabatan' => 'Penerima Jemaat 1', 'nama' => 'Dk. Patuan Situmorang'],
                    ['jabatan' => 'Penerima Jemaat 2', 'nama' => 'Dk. Dwija Ginting'],
                    ['jabatan' => 'Organis', 'nama' => 'Anselmus Libreynra Sinulingga'],
                    ['jabatan' => '', 'nama' => 'Dk. Margaretba Sagala'],
                    ['jabatan' => 'Song Leader', 'nama' => 'Liwarni Simamora'],
                    ['jabatan' => '', 'nama' => 'Mispia Br. Surbakti'],
                    ['jabatan' => 'Worship Leader', 'nama' => '-'],
                    ['jabatan' => 'Multimedia', 'nama' => 'Claresta Br. Ginting'],
                    ['jabatan' => 'Persembahan Pujian', 'nama' => 'Getsemani'],
                ],
            ],
            'sore' => [
                'jam' => '17.00 WIB',
                'lokasi' => 'Gedung Gereja GBKP Bandar Lampung',
                'petugas' => [
                    ['jabatan' => 'Pengkhotbah', 'nama' => 'Pdt. Edy Surbakti, S.Th'],
                    ['jabatan' => 'Liturgis', 'nama' => 'Pt. Normal Ginting'],
                    ['jabatan' => 'Koordinator', 'nama' => 'Pt. Fransta Kacaribu'],
                    ['jabatan' => 'Pengantar Doa', 'nama' => 'Dk. Riza Surbakti'],
                    ['jabatan' => 'Kata Pengantar / Warta Jemaat', 'nama' => 'Dk. Herlan Tarigan'],
                    ['jabatan' => 'Persembahan', 'nama' => 'Dk. Antony Tarigan'],
                    ['jabatan' => 'Kolektan / Counter 1', 'nama' => 'Dk. Riston Surbakti'],
                    ['jabatan' => 'Kolektan / Counter 2', 'nama' => 'Dk. Andelta Sinuraya'],
                    ['jabatan' => 'Penerima Jemaat 1', 'nama' => 'Pt. Masdi Sitepu'],
                    ['jabatan' => 'Penerima Jemaat 2', 'nama' => 'Pt. Em. Gideon Perangin-angin'],
                    ['jabatan' => 'Organis', 'nama' => 'Pt. Bartolomeus Sinuhaji'],
                    ['jabatan' => '', 'nama' => 'Pt. Yetty Br. Tobing'],
                    ['jabatan' => 'Song Leader', 'nama' => 'Angelica Br. Surbakti'],
                    ['jabatan' => '', 'nama' => 'Viko Alexandro Sebayang'],
                    ['jabatan' => 'Worship Leader', 'nama' => 'Nora Nd. Bara Sembiring'],
                    ['jabatan' => 'Multimedia', 'nama' => 'Vina Br. Perangin-angin'],
                    ['jabatan' => 'Persembahan Pujian', 'nama' => '-'],
                ],
            ],
            'info' => [
                'judul' => 'Minggu Advent III',
                'deskripsi' => 'Merupakan minggu natal........',
                'ayat' => '( 2 Timotius 2 : 1 )',
            ],
        ];
    }

    private function getPermataEvent($id)
    {
        $events = [
            5 => [
                'judul' => 'Kebaktian Malam PERMATA',
                'tanggal' => 'Sabtu, 29 Agustus 2026',
                'waktu' => '19:00 - Selesai',
                'lokasi' => 'GBKP Bandar Lampung',
                'tema' => 'Kristus Harapan Kemuliaan',
                'ayat_tema' => 'Kolose 1:27',
                'pembicara' => 'Pdt. Edy Surbakti, S.Th',
                'worship_leader' => 'Angelica Br. Surbakti',
                'gitaris' => 'Viko Alexandro Sebayang',
                'cajonist' => 'Riko Manurung',
                'basist' => 'Daniel Siahaan',
                'singer_1' => 'Melpa Br. Surbakti',
                'singer_2' => 'Nora Nd. Bara Sembiring',
                'multimedia' => 'Claresta Br. Ginting',
                'dokumentasi' => [
                    'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?w=600&q=80',
                    'https://images.unsplash.com/photo-1438232992990-99d20e86b633?w=600&q=80',
                    'https://images.unsplash.com/photo-1529070538774-1843cb3265df?w=600&q=80',
                ],
                'kegiatan' => [
                    ['kode' => 'KMP', 'nama' => 'Kebaktian Malam PERMATA', 'route' => '#'],
                    ['kode' => 'PA', 'nama' => 'Pendalaman Alkitab', 'route' => '#'],
                    ['kode' => 'Jam Doa', 'nama' => 'Ibadah Jam doa', 'route' => '#'],
                ],
            ],
            7 => [
                'judul' => 'Ibadah Lansia SAITUN',
                'tanggal' => 'Minggu, 30 Agustus 2026',
                'waktu' => '09:00 - Selesai',
                'lokasi' => 'GBKP Bandar Lampung',
                'tema' => 'Tetap Setia Sampai Akhir',
                'ayat_tema' => '2 Timotius 4:7',
                'pembicara' => 'Pdt. Andreas Pranata Meliala, M.Th',
                'dokumentasi' => [
                    'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?w=600&q=80',
                    'https://images.unsplash.com/photo-1438232992990-99d20e86b633?w=600&q=80',
                ],
                'kegiatan' => [
                    ['kode' => 'Riwayat Ibadah', 'nama' => 'Riwayat Ibadah Saitun', 'route' => '#'],
                ],
            ],
            8 => [
                'judul' => 'Ibadah Janda NAOMI',
                'tanggal' => 'Sabtu, 5 September 2026',
                'waktu' => '10:00 - Selesai',
                'lokasi' => 'GBKP Bandar Lampung',
                'tema' => 'Kuat dan Berserah',
                'ayat_tema' => 'Yesaya 41:10',
                'pembicara' => 'Pdt. Edy Surbakti, S.Th',
                'dokumentasi' => [
                    'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?w=600&q=80',
                    'https://images.unsplash.com/photo-1529070538774-1843cb3265df?w=600&q=80',
                ],
                'kegiatan' => [
                    ['kode' => 'Riwayat Ibadah', 'nama' => 'Riwayat Ibadah Naomi', 'route' => '#'],
                ],
            ],
        ];

        return $events[$id] ?? null;
    }
}