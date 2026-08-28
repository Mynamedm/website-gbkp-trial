<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Category;
use App\Models\Event;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    public function index()
    {
        $schedules = Schedule::where('status', 'active')
            ->whereDate('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->take(6)
            ->get();

        $announcements = Announcement::where('status', 'active')
            ->orderByDesc('date')
            ->take(3)
            ->get();

        $events = Event::where('status', 'active')
            ->orderByDesc('date')
            ->take(3)
            ->get();

        return view('client.index', compact('schedules', 'announcements', 'events'));
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

    public function aboutChurch()
    {
        return view('client.about-church.index');
    }

    public function aboutKategorial()
    {
        return view('client.about-kategorial.index');
    }

    public function kategorialDetail($slug)
    {
        $kategorial = $this->getKategorialData($slug);

        if (!$kategorial) {
            abort(404);
        }

        return view('client.about-kategorial.detail', compact('kategorial', 'slug'));
    }

    public function events()
    {
        $currentYear = date('Y');
        $years = collect(range($currentYear, $currentYear - 3));
        $categories = Category::where('type', 'event')->get();

        $categoryColors = $categories->pluck('color', 'name')->toArray();

        $query = Event::where('status', 'published');

        if (request('year')) {
            $query->whereYear('date', request('year'));
        }
        if (request('category')) {
            $query->where('category', request('category'));
        }
        if (request('search')) {
            $search = strtolower(request('search'));
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(title) like ?', ['%' . $search . '%'])
                  ->orWhereRaw('LOWER(description) like ?', ['%' . $search . '%']);
            });
        }

        $events = $query->latest('date')->paginate(9)->withQueryString();

        $categoryColors = Category::where('type', 'event')->pluck('color', 'name')->toArray();

        return view('client.event.index', compact('events', 'years', 'categories', 'categoryColors'));
    }

    public function eventSearch(Request $request)
    {
        $query = $request->get('q', '');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $events = Event::where('status', 'published')
            ->where(function ($q) use ($query) {
                $q->whereRaw('LOWER(title) like ?', ['%' . strtolower($query) . '%'])
                  ->orWhereRaw('LOWER(description) like ?', ['%' . strtolower($query) . '%']);
            })
            ->latest('date')
            ->take(8)
            ->get(['id', 'title', 'slug', 'description', 'date', 'category', 'location']);

        $results = $events->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'slug' => $event->slug,
                'description' => Str::limit($event->description, 80),
                'date' => $event->date->translatedFormat('d M Y'),
                'category' => $event->category,
                'location' => $event->location,
                'url' => route('client.events.detail', $event->slug),
            ];
        });

        return response()->json($results);
    }

    public function eventDetail($slug)
    {
        $event = Event::where('slug', $slug)->where('status', 'published')->firstOrFail();

        $relatedEvents = Event::where('status', 'published')
            ->where('id', '!=', $event->id)
            ->latest('date')
            ->take(3)
            ->get();

        $categoryColors = Category::where('type', 'event')->pluck('color', 'name')->toArray();

        return view('client.event.detail', compact('event', 'relatedEvents', 'categoryColors'));
    }

    public function eventArchive($year)
    {
        $events = Event::where('status', 'published')
            ->whereYear('date', $year)
            ->latest('date')
            ->paginate(9);

        $archiveYears = Event::where('status', 'published')
            ->selectRaw('EXTRACT(YEAR FROM date) as year, COUNT(*) as count')
            ->groupByRaw('EXTRACT(YEAR FROM date)')
            ->orderByDesc('year')
            ->get();

        $categoryColors = Category::where('type', 'event')->pluck('color', 'name')->toArray();

        return view('client.event.archive', compact('events', 'year', 'archiveYears', 'categoryColors'));
    }

    private function getKategorialData($slug)
    {
        $data = [
            'moria' => [
                'name' => 'MORIA',
                'color' => 'pink',
                'tagline' => 'Persekutuan Kaum Ibu',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>',
                'deskripsi' => 'Moria adalah persekutuan kaum ibu di GBKP Bandar Lampung. Kategorial ini melayani dan membina para ibu dalam kehidupan beriman, berkeluarga, dan bermasyarakat.',
                'pengurus' => [
                    ['jabatan' => 'Ketua', 'nama' => 'Ny. Ratna Ginting'],
                    ['jabatan' => 'Wakil Ketua', 'nama' => 'Ny. Sri Hartati'],
                    ['jabatan' => 'Sekretaris', 'nama' => 'Ny. Rina br. Sitepu'],
                    ['jabatan' => 'Bendahara', 'nama' => 'Ny. Dewi br. Karo'],
                ],
                'sektor' => [
                    ['nama' => 'SEKTOR YERIKHO', 'host' => 'Nd. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'jumlah' => '28'],
                    ['nama' => 'SEKTOR NAZARETH', 'host' => 'Nd. Siti Surbakti', 'lokasi' => 'Jambur Cawir Metua', 'jumlah' => '25'],
                    ['nama' => 'SEKTOR TIBERIAS', 'host' => 'Nd. Rina br. Sitepu', 'lokasi' => 'Jambur Cawir Metua', 'jumlah' => '30'],
                    ['nama' => 'SEKTOR GETSEMANI', 'host' => 'Nd. Dewi br. Karo', 'lokasi' => 'Jambur Cawir Metua', 'jumlah' => '22'],
                    ['nama' => 'SEKTOR JERUSALEM', 'host' => 'Nd. Ester br. Ginting', 'lokasi' => 'Jambur Cawir Metua', 'jumlah' => '27'],
                    ['nama' => 'SEKTOR KAPERNAUM', 'host' => 'Nd. Ruth br. Sinulingga', 'lokasi' => 'Jambur Cawir Metua', 'jumlah' => '26'],
                    ['nama' => 'SEKTOR BETHANY', 'host' => 'Nd. Sarah br. Perangin-angin', 'lokasi' => 'Jambur Cawir Metua', 'jumlah' => '28'],
                ],
                'total_anggota' => '186',
                'dokumentasi' => [
                    ['judul' => 'Persekutuan Doa Moria', 'tanggal' => '15 Agustus 2026', 'warna' => 'from-pink-100 to-pink-50'],
                    ['judul' => 'Bakti Sosial Moria', 'tanggal' => '10 Agustus 2026', 'warna' => 'from-pink-100 to-pink-50'],
                    ['judul' => 'Ibadah Rutin Moria', 'tanggal' => '05 Agustus 2026', 'warna' => 'from-pink-100 to-pink-50'],
                    ['judul' => 'Kunjungan Kasih', 'tanggal' => '01 Agustus 2026', 'warna' => 'from-pink-100 to-pink-50'],
                ],
            ],
            'mamre' => [
                'name' => 'MAMRE',
                'color' => 'blue',
                'tagline' => 'Persekutuan Kaum Ayah',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>',
                'deskripsi' => 'Mamre adalah persekutuan kaum ayah di GBKP Bandar Lampung. Kategorial ini menjadi wadah bagi para pria untuk bertumbuh dalam iman dan memperkuat peran sebagai pemimpin keluarga.',
                'pengurus' => [
                    ['jabatan' => 'Ketua', 'nama' => 'Pt. Andreas Ginting'],
                    ['jabatan' => 'Wakil Ketua', 'nama' => 'Pt. Budi Surbakti'],
                    ['jabatan' => 'Sekretaris', 'nama' => 'Pt. Rudi Sinulingga'],
                    ['jabatan' => 'Bendahara', 'nama' => 'Pt. Hiskia Barus'],
                ],
                'sektor' => [
                    ['nama' => 'SEKTOR KANAAN', 'host' => 'Pt. Ari Ginting', 'lokasi' => 'Jambur Cawir Metua', 'jumlah' => '22'],
                    ['nama' => 'SEKTOR GALILEA', 'host' => 'Pt. Budi Surbakti', 'lokasi' => 'Jambur Cawir Metua', 'jumlah' => '20'],
                    ['nama' => 'SEKTOR BETESDA', 'host' => 'Pt. Rudi Sinulingga', 'lokasi' => 'Jambur Cawir Metua', 'jumlah' => '25'],
                    ['nama' => 'SEKTOR JERUSALEM', 'host' => 'Pt. Hiskia Barus', 'lokasi' => 'Jambur Cawir Metua', 'jumlah' => '28'],
                    ['nama' => 'SEKTOR PHILIPI', 'host' => 'Pt. Normal Ginting', 'lokasi' => 'Jambur Cawir Metua', 'jumlah' => '27'],
                ],
                'total_anggota' => '142',
                'dokumentasi' => [
                    ['judul' => 'Persekutuan Doa Mamre', 'tanggal' => '14 Agustus 2026', 'warna' => 'from-blue-100 to-blue-50'],
                    ['judul' => 'Diskusi Keimanan', 'tanggal' => '08 Agustus 2026', 'warna' => 'from-blue-100 to-blue-50'],
                    ['judul' => 'Bakti Sosial Mamre', 'tanggal' => '03 Agustus 2026', 'warna' => 'from-blue-100 to-blue-50'],
                ],
            ],
            'pjj' => [
                'name' => 'PJJ',
                'color' => 'teal',
                'tagline' => 'Perpulungen Jabu-Jabu',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>',
                'deskripsi' => 'PJJ (Perpulungen Jabu-Jabu) adalah persekutuan keluarga di GBKP Bandar Lampung. Kategorial ini membina kehidupan keluarga Kristen dalam berbagai aspek.',
                'pengurus' => [
                    ['jabatan' => 'Ketua', 'nama' => 'Pt. Jonatan Ginting'],
                    ['jabatan' => 'Wakil Ketua', 'nama' => 'Pt. David Surbakti'],
                    ['jabatan' => 'Sekretaris', 'nama' => 'Ny. Linda br. Sinulingga'],
                    ['jabatan' => 'Bendahara', 'nama' => 'Pt. Michael Perangin-angin'],
                ],
                'sektor' => [
                    ['nama' => 'SEKTOR YERIKHO', 'host' => 'Pt. Jonatan Ginting', 'lokasi' => 'Jambur Cawir Metua', 'jumlah' => '24'],
                    ['nama' => 'SEKTOR NAZARETH', 'host' => 'Pt. David Surbakti', 'lokasi' => 'Jambur Cawir Metua', 'jumlah' => '22'],
                    ['nama' => 'SEKTOR TIBERIAS', 'host' => 'Pt. Michael Perangin-angin', 'lokasi' => 'Jambur Cawir Metua', 'jumlah' => '26'],
                    ['nama' => 'SEKTOR GETSEMANI', 'host' => 'Pt. Rian Barus', 'lokasi' => 'Jambur Cawir Metua', 'jumlah' => '23'],
                    ['nama' => 'SEKTOR JERUSALEM', 'host' => 'Pt. Thomas Karo', 'lokasi' => 'Jambur Cawir Metua', 'jumlah' => '25'],
                    ['nama' => 'SEKTOR KAPERNAUM', 'host' => 'Pt. Steven Ginting', 'lokasi' => 'Jambur Cawir Metua', 'jumlah' => '21'],
                    ['nama' => 'SEKTOR BETHANY', 'host' => 'Pt. Richard Sinulingga', 'lokasi' => 'Jambur Cawir Metua', 'jumlah' => '23'],
                ],
                'total_anggota' => '164',
                'dokumentasi' => [
                    ['judul' => 'Persekutuan Keluarga PJJ', 'tanggal' => '12 Agustus 2026', 'warna' => 'from-teal-100 to-teal-50'],
                    ['judul' => 'Keluarga Beriman', 'tanggal' => '06 Agustus 2026', 'warna' => 'from-teal-100 to-teal-50'],
                    ['judul' => 'Bakti Sosial PJJ', 'tanggal' => '02 Agustus 2026', 'warna' => 'from-teal-100 to-teal-50'],
                ],
            ],
            'permata' => [
                'name' => 'PERMATA',
                'color' => 'violet',
                'tagline' => 'Persekutuan Pemuda-Pemudi',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/>',
                'deskripsi' => 'PERMATA adalah persekutuan pemuda-pemudi di GBKP Bandar Lampung. Kategorial ini menjadi wadah bagi generasi muda untuk bertumbuh dalam iman, berkarya, dan melayani.',
                'pengurus' => [
                    ['jabatan' => 'Ketua', 'nama' => 'Angelica br. Surbakti'],
                    ['jabatan' => 'Wakil Ketua', 'nama' => 'Viko A. Sebayang'],
                    ['jabatan' => 'Sekretaris', 'nama' => 'Claresta br. Ginting'],
                    ['jabatan' => 'Bendahara', 'nama' => 'Daniel Siahaan'],
                ],
                'sektor' => null,
                'anggota' => [
                    ['nama' => 'Angelica br. Surbakti', 'peran' => 'Worship Leader'],
                    ['nama' => 'Viko A. Sebayang', 'peran' => 'Gitaris'],
                    ['nama' => 'Claresta br. Ginting', 'peran' => 'Multimedia'],
                    ['nama' => 'Daniel Siahaan', 'peran' => 'Basist'],
                    ['nama' => 'Riko Manurung', 'peran' => 'Cajonist'],
                    ['nama' => 'Melpa br. Surbakti', 'peran' => 'Singer'],
                    ['nama' => 'Nora Nd. Bara Sembiring', 'peran' => 'Singer'],
                ],
                'total_anggota' => '128',
                'dokumentasi' => [
                    ['judul' => 'Kebaktian Malam PERMATA', 'tanggal' => '29 Agustus 2026', 'warna' => 'from-violet-100 to-violet-50'],
                    ['judul' => 'Worship Night', 'tanggal' => '22 Agustus 2026', 'warna' => 'from-violet-100 to-violet-50'],
                    ['judul' => 'Kajian Alkitab Pemuda', 'tanggal' => '15 Agustus 2026', 'warna' => 'from-violet-100 to-violet-50'],
                    ['judul' => 'Bakti Sosial PERMATA', 'tanggal' => '08 Agustus 2026', 'warna' => 'from-violet-100 to-violet-50'],
                ],
            ],
            'kakr' => [
                'name' => 'KA-KR',
                'color' => 'green',
                'tagline' => 'Kelas Anak & Kelas Remaja',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/>',
                'deskripsi' => 'KA-KR (Kelas Anak - Kelas Remaja) adalah pelayanan untuk anak-anak dan remaja di GBKP Bandar Lampung. Kategorial ini membina generasi muda sejak usia dini hingga remaja.',
                'pengurus' => [
                    ['jabatan' => 'Ketua', 'nama' => 'Dk. Martha br. Ketaren'],
                    ['jabatan' => 'Wakil Ketua', 'nama' => 'Dk. Ester br. Sembiring'],
                    ['jabatan' => 'Sekretaris', 'nama' => 'Dk. Ruth br. Ginting'],
                    ['jabatan' => 'Bendahara', 'nama' => 'Dk. Sarah br. Perangin-angin'],
                ],
                'sektor' => null,
                'anggota' => [
                    ['nama' => 'Kelas Batita - Balita', 'peran' => 'Usia 0-3 Tahun', 'lokasi' => 'PAUD', 'waktu' => '08:00 WIB'],
                    ['nama' => 'Kelas Kecil', 'peran' => 'Usia 4-6 Tahun', 'lokasi' => 'PAUD', 'waktu' => '08:00 WIB'],
                    ['nama' => 'Kelas Tanggung', 'peran' => 'Usia 7-9 Tahun', 'lokasi' => 'PAUD', 'waktu' => '08:00 WIB'],
                    ['nama' => 'Kelas Remaja', 'peran' => 'Usia 10-12 Tahun', 'lokasi' => 'PAUD / Ruang Kesehatan', 'waktu' => '08:00 WIB'],
                ],
                'total_anggota' => '95',
                'dokumentasi' => [
                    ['judul' => 'Sekolah Minggu', 'tanggal' => '27 Agustus 2026', 'warna' => 'from-green-100 to-green-50'],
                    ['judul' => 'Katekisasi Anak', 'tanggal' => '20 Agustus 2026', 'warna' => 'from-green-100 to-green-50'],
                    ['judul' => 'Persekutuan Remaja', 'tanggal' => '13 Agustus 2026', 'warna' => 'from-green-100 to-green-50'],
                ],
            ],
            'saitun' => [
                'name' => 'SAITUN',
                'color' => 'amber',
                'tagline' => 'Persekutuan Lansia',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>',
                'deskripsi' => 'SAITUN adalah persekutuan kaum lansia di GBKP Bandar Lampung. Kategorial ini melayani dan membina para lansia dengan penuh kasih dan perhatian.',
                'pengurus' => [
                    ['jabatan' => 'Ketua', 'nama' => 'Pt. Tulus Ginting'],
                    ['jabatan' => 'Wakil Ketua', 'nama' => 'Pt. Ngading Surbakti'],
                    ['jabatan' => 'Sekretaris', 'nama' => 'Nd. Riama br. Karo'],
                    ['jabatan' => 'Bendahara', 'nama' => 'Nd. Tumini br. Sitepu'],
                ],
                'sektor' => null,
                'anggota' => [
                    ['nama' => 'Lansia Aktif', 'peran' => 'Anggota aktif yang masih berkegiatan'],
                    ['nama' => 'Lansia Pasif', 'peran' => 'Anggota yang membutuhkan kunjungan'],
                ],
                'total_anggota' => '67',
                'dokumentasi' => [
                    ['judul' => 'Ibadah Lansia SAITUN', 'tanggal' => '30 Agustus 2026', 'warna' => 'from-amber-100 to-amber-50'],
                    ['judul' => 'Kunjungan Kasih', 'tanggal' => '23 Agustus 2026', 'warna' => 'from-amber-100 to-amber-50'],
                    ['judul' => 'Persekutuan Doa Lansia', 'tanggal' => '16 Agustus 2026', 'warna' => 'from-amber-100 to-amber-50'],
                ],
            ],
            'naomi' => [
                'name' => 'NAOMI',
                'color' => 'rose',
                'tagline' => 'Persekutuan Kaum Janda',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>',
                'deskripsi' => 'NAOMI adalah persekutuan kaum janda di GBKP Bandar Lampung. Kategorial ini menjadi tempat perlindungan dan penguatan bagi kaum janda dalam menjalani kehidupan.',
                'pengurus' => [
                    ['jabatan' => 'Ketua', 'nama' => 'Nd. Naomi br. Ginting'],
                    ['jabatan' => 'Wakil Ketua', 'nama' => 'Nd. Herawati br. Sinulingga'],
                    ['jabatan' => 'Sekretaris', 'nama' => 'Nd. Ratna br. Surbakti'],
                    ['jabatan' => 'Bendahara', 'nama' => 'Nd. Siti br. Perangin-angin'],
                ],
                'sektor' => null,
                'anggota' => [
                    ['nama' => 'Janda Aktif', 'peran' => 'Anggota aktif yang berkegiatan'],
                    ['nama' => 'Janda Pasif', 'peran' => 'Anggota yang membutuhkan perhatian'],
                ],
                'total_anggota' => '43',
                'dokumentasi' => [
                    ['judul' => 'Ibadah Janda NAOMI', 'tanggal' => '5 September 2026', 'warna' => 'from-rose-100 to-rose-50'],
                    ['judul' => 'Persekutuan Doa NAOMI', 'tanggal' => '28 Agustus 2026', 'warna' => 'from-rose-100 to-rose-50'],
                    ['judul' => 'Bakti Sosial NAOMI', 'tanggal' => '21 Agustus 2026', 'warna' => 'from-rose-100 to-rose-50'],
                ],
            ],
        ];

        return $data[$slug] ?? null;
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