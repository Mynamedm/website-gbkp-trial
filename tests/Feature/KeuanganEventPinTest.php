<?php

namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KeuanganEventPinTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('keuangan.pin', '123456');
        config()->set('keuangan.whatsapp', '6281234567890');
    }

    private function keuanganEvent(array $attributes = []): Event
    {
        return Event::factory()->create(array_merge([
            'title' => 'Laporan Keuangan Gereja',
            'slug' => 'laporan-keuangan-gereja',
            'category' => 'keuangan',
            'category_id' => null,
            'description' => 'Rincian pemasukan dan pengeluaran gereja bulan ini.',
            'content' => 'Isi laporan keuangan yang bersifat rahasia.',
            'status' => 'published',
        ], $attributes));
    }

    public function test_berita_keuangan_menampilkan_box_pin_dan_tidak_membocorkan_isi(): void
    {
        $event = $this->keuanganEvent();

        $response = $this->get(route('client.events.detail', $event->slug));

        $response->assertOk()
            ->assertSee('Berita Terkunci')
            ->assertSee('PIN Berita')
            ->assertSee('Lupa PIN? Hubungi Admin via WhatsApp')
            ->assertSee('https://wa.me/6281234567890', false)
            ->assertDontSee($event->description)
            ->assertDontSee($event->content);
    }

    public function test_pin_benar_membuka_berita_keuangan(): void
    {
        $event = $this->keuanganEvent();

        $response = $this->post(route('client.events.unlock', $event->slug), ['pin' => '123456']);

        $response->assertRedirect(route('client.events.detail', $event->slug))
            ->assertSessionHas('keuangan_unlocked', true);

        $this->get(route('client.events.detail', $event->slug))
            ->assertOk()
            ->assertSee($event->description)
            ->assertSee($event->content)
            ->assertDontSee('Berita Terkunci');
    }

    public function test_pin_salah_tidak_membuka_berita(): void
    {
        $event = $this->keuanganEvent();

        $response = $this->from(route('client.events.detail', $event->slug))
            ->post(route('client.events.unlock', $event->slug), ['pin' => '999999']);

        $response->assertRedirect(route('client.events.detail', $event->slug))
            ->assertSessionHasErrors('pin')
            ->assertSessionMissing('keuangan_unlocked');

        $this->get(route('client.events.detail', $event->slug))
            ->assertOk()
            ->assertSee('Berita Terkunci')
            ->assertSee('PIN yang Anda masukkan salah')
            ->assertDontSee($event->description);
    }

    public function test_pin_kosong_menampilkan_pesan_validasi(): void
    {
        $event = $this->keuanganEvent();

        $this->from(route('client.events.detail', $event->slug))
            ->post(route('client.events.unlock', $event->slug), ['pin' => ''])
            ->assertSessionHasErrors('pin');
    }

    public function test_kategori_lain_tidak_terkunci(): void
    {
        $event = $this->keuanganEvent([
            'title' => 'Ibadah Minggu',
            'slug' => 'ibadah-minggu',
            'category' => 'koinonia',
            'description' => 'Ibadah minggu jemaat.',
            'content' => 'Informasi ibadah minggu.',
        ]);

        $this->get(route('client.events.detail', $event->slug))
            ->assertOk()
            ->assertSee($event->description)
            ->assertSee($event->content)
            ->assertDontSee('Berita Terkunci');
    }

    public function test_unlock_berlaku_untuk_semua_berita_keuangan_dalam_sesi(): void
    {
        $first = $this->keuanganEvent();
        $second = $this->keuanganEvent([
            'title' => 'Laporan Keuangan Triwulan',
            'slug' => 'laporan-keuangan-triwulan',
            'description' => 'Rincian triwulan.',
            'content' => 'Isi triwulan.',
        ]);

        $this->post(route('client.events.unlock', $first->slug), ['pin' => '123456'])
            ->assertSessionHas('keuangan_unlocked', true);

        $this->get(route('client.events.detail', $second->slug))
            ->assertOk()
            ->assertSee($second->description)
            ->assertDontSee('Berita Terkunci');
    }

    public function test_daftar_kegiatan_menyembunyikan_cuplikan_berita_keuangan_terkunci(): void
    {
        $event = $this->keuanganEvent();

        $this->get(route('client.events'))
            ->assertOk()
            ->assertSee($event->title)
            ->assertSee('Berita terkunci. Masukkan PIN untuk membaca.')
            ->assertDontSee($event->description);
    }

    public function test_unlock_hanya_untuk_berita_kategori_keuangan(): void
    {
        $event = $this->keuanganEvent([
            'title' => 'Ibadah Minggu',
            'slug' => 'ibadah-minggu',
            'category' => 'koinonia',
        ]);

        $this->post(route('client.events.unlock', $event->slug), ['pin' => '123456'])
            ->assertRedirect(route('client.events.detail', $event->slug))
            ->assertSessionMissing('keuangan_unlocked');
    }
}
