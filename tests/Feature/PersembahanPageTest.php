<?php

namespace Tests\Feature;

use App\Models\OfferingCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PersembahanPageTest extends TestCase
{
    use RefreshDatabase;

    private function category(string $name, string $slug, int $sortOrder, bool $active = true): OfferingCategory
    {
        return OfferingCategory::create([
            'name' => $name,
            'slug' => $slug,
            'description' => "Keterangan {$name}",
            'bank_name' => 'Bank BCA',
            'bank_account_number' => '9876543210',
            'bank_account_name' => 'GBKP Bandar Lampung',
            'is_active' => $active,
            'sort_order' => $sortOrder,
        ]);
    }

    public function test_halaman_persembahan_hanya_menampilkan_satu_qr_persembahan_umum(): void
    {
        $this->category('Persepuluhan', 'persepuluhan', 1);
        $this->category('Persembahan Umum', 'persembahan-umum', 2);
        $this->category('Uang Kas Runggun', 'uang-kas-runggun', 3);

        $this->get(route('client.persembahan'))
            ->assertOk()
            ->assertSee('Persembahan Umum')
            ->assertDontSee('Persepuluhan')
            ->assertDontSee('Uang Kas Runggun')
            ->assertSee('Cara Berpersembahan')
            ->assertSee('Scan QR Code');
    }

    public function test_halaman_persembahan_menampilkan_langkah_di_sebelah_qr(): void
    {
        $this->category('Persembahan Umum', 'persembahan-umum', 1);

        $this->get(route('client.persembahan'))
            ->assertOk()
            ->assertSee('Buka aplikasi pembayaran')
            ->assertSee('Pilih menu Scan QRIS')
            ->assertSee('Konfirmasi &amp; simpan bukti', false)
            ->assertSee('GBKP Bandar Lampung');
    }

    public function test_halaman_persembahan_tetap_tampil_jika_persembahan_umum_nonaktif(): void
    {
        $this->category('Persepuluhan', 'persepuluhan', 1);
        $this->category('Persembahan Umum', 'persembahan-umum', 2, active: false);

        $this->get(route('client.persembahan'))
            ->assertOk()
            ->assertSee('Persepuluhan')
            ->assertDontSee('Persembahan Umum');
    }

    public function test_halaman_persembahan_menampilkan_pesan_jika_belum_ada_kategori(): void
    {
        $this->get(route('client.persembahan'))
            ->assertOk()
            ->assertSee('Informasi Persembahan Belum Tersedia');
    }
}
