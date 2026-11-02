<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class KeuanganEventPdfTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('keuangan.pin', '123456');
        Storage::fake('local');
    }

    private function admin(): User
    {
        $user = User::factory()->create();
        Role::findOrCreate('super_admin', 'web');
        $user->assignRole('super_admin');

        return $user;
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

    private function eventWithPdf(array $attributes = []): Event
    {
        $event = $this->keuanganEvent(array_merge([
            'pdf_path' => 'events/pdf/laporan.pdf',
        ], $attributes));

        Storage::disk('local')->put($event->pdf_path, "%PDF-1.4\ncontoh laporan keuangan");

        return $event;
    }

    public function test_pin_benar_langsung_membuka_pdf_jika_tersedia(): void
    {
        $event = $this->eventWithPdf();

        $this->post(route('client.events.unlock', $event->slug), ['pin' => '123456'])
            ->assertRedirect(route('client.events.pdf', $event->slug));

        $response = $this->get(route('client.events.pdf', $event->slug));

        $response->assertOk()
            ->assertHeader('content-type', 'application/pdf');

        $this->assertStringContainsString('inline', $response->headers->get('content-disposition'));
        $this->assertStringContainsString('laporan-keuangan-gereja.pdf', $response->headers->get('content-disposition'));
    }

    public function test_pdf_tidak_bisa_diakses_sebelum_pin(): void
    {
        $event = $this->eventWithPdf();

        $this->get(route('client.events.pdf', $event->slug))
            ->assertRedirect(route('client.events.detail', $event->slug))
            ->assertSessionHasErrors('pin');

        $this->get(route('client.events.pdf.download', $event->slug))
            ->assertRedirect(route('client.events.detail', $event->slug));
    }

    public function test_pdf_bisa_diunduh_setelah_pin(): void
    {
        $event = $this->eventWithPdf();

        $response = $this->withSession(['keuangan_unlocked' => true])
            ->get(route('client.events.pdf.download', $event->slug));

        $response->assertOk()
            ->assertHeader('content-type', 'application/pdf');

        $this->assertStringContainsString('attachment', $response->headers->get('content-disposition'));
        $this->assertStringContainsString('laporan-keuangan-gereja.pdf', $response->headers->get('content-disposition'));
    }

    public function test_detail_setelah_unlock_menampilkan_tombol_buka_dan_unduh_pdf(): void
    {
        $event = $this->eventWithPdf();

        $this->withSession(['keuangan_unlocked' => true])
            ->get(route('client.events.detail', $event->slug))
            ->assertOk()
            ->assertSee('Buka PDF')
            ->assertSee('Unduh PDF')
            ->assertSee(route('client.events.pdf', $event->slug), false)
            ->assertSee(route('client.events.pdf.download', $event->slug), false);
    }

    public function test_detail_terkunci_tidak_menampilkan_tautan_pdf(): void
    {
        $event = $this->eventWithPdf();

        $this->get(route('client.events.detail', $event->slug))
            ->assertOk()
            ->assertDontSee('Buka PDF')
            ->assertDontSee(route('client.events.pdf', $event->slug), false);
    }

    public function test_pdf_hanya_untuk_kategori_keuangan(): void
    {
        $event = $this->eventWithPdf([
            'title' => 'Ibadah Minggu',
            'slug' => 'ibadah-minggu',
            'category' => 'koinonia',
        ]);

        $this->withSession(['keuangan_unlocked' => true])
            ->get(route('client.events.pdf', $event->slug))
            ->assertNotFound();
    }

    public function test_pdf_404_jika_file_tidak_ada(): void
    {
        $event = $this->keuanganEvent(['pdf_path' => 'events/pdf/tidak-ada.pdf']);

        $this->withSession(['keuangan_unlocked' => true])
            ->get(route('client.events.pdf', $event->slug))
            ->assertNotFound();
    }

    public function test_admin_event_page_menampilkan_field_pdf(): void
    {
        $event = $this->eventWithPdf();

        $this->actingAs($this->admin())
            ->get(route('admin.events.index'))
            ->assertOk()
            ->assertSee('Laporan Keuangan (PDF)')
            ->assertSee(basename($event->pdf_path));
    }

    public function test_admin_dapat_mengunggah_pdf_keuangan(): void
    {
        $category = Category::firstOrCreate(
            ['slug' => 'keuangan'],
            ['name' => 'keuangan', 'type' => 'event']
        );

        $response = $this->actingAs($this->admin())->post(route('admin.events.store'), [
            'title' => 'Laporan Keuangan Baru',
            'description' => 'Laporan keuangan bulan ini.',
            'date' => '2026-11-02',
            'category_id' => $category->id,
            'status' => 'published',
            'pdf' => UploadedFile::fake()->createWithContent('laporan.pdf', "%PDF-1.4\ncontoh laporan keuangan"),
        ]);

        $response->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.events.index'));

        $event = Event::where('slug', 'laporan-keuangan-baru')->firstOrFail();

        $this->assertNotNull($event->pdf_path);
        $this->assertStringStartsWith('events/pdf/', $event->pdf_path);
        Storage::disk('local')->assertExists($event->pdf_path);
    }

    public function test_admin_dapat_menghapus_pdf(): void
    {
        $category = Category::firstOrCreate(
            ['slug' => 'keuangan'],
            ['name' => 'keuangan', 'type' => 'event']
        );

        $event = $this->eventWithPdf(['category_id' => $category->id]);

        $this->actingAs($this->admin())->put(route('admin.events.update', $event->slug), [
            'title' => $event->title,
            'description' => $event->description,
            'date' => $event->date->format('Y-m-d'),
            'category_id' => $category->id,
            'status' => 'published',
            'remove_pdf' => '1',
        ])->assertSessionHasNoErrors();

        $event->refresh();

        $this->assertNull($event->pdf_path);
        Storage::disk('local')->assertMissing('events/pdf/laporan.pdf');
    }
}
