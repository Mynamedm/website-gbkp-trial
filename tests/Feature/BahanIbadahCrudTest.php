<?php

namespace Tests\Feature;

use App\Models\Reflection;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class BahanIbadahCrudTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        $user = User::factory()->create();
        Role::findOrCreate('super_admin', 'web');
        $user->assignRole('super_admin');

        return $user;
    }

    public function test_admin_can_open_bahan_ibadah_page(): void
    {
        $response = $this->actingAs($this->admin())->get(route('admin.bahan-ibadah.index'));

        $response->assertOk();
        $response->assertSee('Daftar Bahan Ibadah');
        $response->assertSee('Tambah Bahan Ibadah');
    }

    public function test_admin_bahan_ibadah_page_does_not_list_renungan(): void
    {
        Reflection::create([
            'title' => 'Renungan Biasa',
            'date' => '2026-08-01',
            'status' => 'active',
            'type' => Reflection::TYPE_RENUNGAN,
        ]);

        $this->actingAs($this->admin())
            ->get(route('admin.bahan-ibadah.index'))
            ->assertOk()
            ->assertDontSee('Renungan Biasa');
    }

    public function test_admin_can_create_bahan_ibadah(): void
    {
        $response = $this->actingAs($this->admin())->post(route('admin.bahan-ibadah.store'), [
            'title' => 'Bahan Ibadah Minggu',
            'date' => '2026-08-09',
            'church_day' => 'Minggu Trinitas',
            'theme' => 'Tuhan Menemanimu',
            'bible_verse' => 'Matius 14 : 22 - 33',
            'bible_translation' => 'Terjemahan Baru',
            'body' => 'Isi bahan ibadah.',
            'status' => 'active',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('admin.bahan-ibadah.index'));

        $this->assertDatabaseHas('reflections', [
            'title' => 'Bahan Ibadah Minggu',
            'type' => Reflection::TYPE_BAHAN_IBADAH,
        ]);
    }

    public function test_admin_can_update_bahan_ibadah(): void
    {
        $reflection = Reflection::create([
            'title' => 'Judul Lama',
            'date' => '2026-08-01',
            'status' => 'active',
            'type' => Reflection::TYPE_BAHAN_IBADAH,
        ]);

        $this->actingAs($this->admin())->put(route('admin.bahan-ibadah.update', $reflection), [
            'title' => 'Judul Baru',
            'date' => '2026-08-08',
            'status' => 'inactive',
            'body' => 'Isi baru.',
        ])->assertSessionHasNoErrors();

        $reflection->refresh();

        $this->assertSame('Judul Baru', $reflection->title);
        $this->assertSame('inactive', $reflection->status);
        $this->assertSame(Reflection::TYPE_BAHAN_IBADAH, $reflection->type);
    }

    public function test_admin_can_delete_bahan_ibadah(): void
    {
        $reflection = Reflection::create([
            'title' => 'Akan Dihapus',
            'date' => '2026-08-01',
            'status' => 'active',
            'type' => Reflection::TYPE_BAHAN_IBADAH,
        ]);

        $this->actingAs($this->admin())
            ->delete(route('admin.bahan-ibadah.destroy', $reflection))
            ->assertSessionHasNoErrors();

        $this->assertNull($reflection->fresh());
    }

    public function test_admin_cannot_update_renungan_through_bahan_ibadah_route(): void
    {
        $reflection = Reflection::create([
            'title' => 'Renungan Biasa',
            'date' => '2026-08-01',
            'status' => 'active',
            'type' => Reflection::TYPE_RENUNGAN,
        ]);

        $this->actingAs($this->admin())
            ->put(route('admin.bahan-ibadah.update', $reflection), [
                'title' => 'Diubah',
                'date' => '2026-08-08',
                'status' => 'active',
            ])
            ->assertNotFound();
    }

    public function test_public_bahan_ibadah_list_only_shows_active_bahan_ibadah(): void
    {
        Reflection::create([
            'title' => 'Bahan Aktif',
            'date' => '2026-08-01',
            'status' => 'active',
            'type' => Reflection::TYPE_BAHAN_IBADAH,
        ]);
        Reflection::create([
            'title' => 'Bahan Nonaktif',
            'date' => '2026-08-02',
            'status' => 'inactive',
            'type' => Reflection::TYPE_BAHAN_IBADAH,
        ]);
        Reflection::create([
            'title' => 'Renungan Biasa',
            'date' => '2026-08-03',
            'status' => 'active',
            'type' => Reflection::TYPE_RENUNGAN,
        ]);

        $this->get(route('client.bahan-ibadah'))
            ->assertOk()
            ->assertSee('Bahan Aktif')
            ->assertDontSee('Bahan Nonaktif')
            ->assertDontSee('Renungan Biasa');
    }

    public function test_public_bahan_ibadah_detail_only_shows_bahan_ibadah_type(): void
    {
        $bahan = Reflection::create([
            'title' => 'Bahan Ibadah Lengkap',
            'date' => '2026-07-26',
            'status' => 'active',
            'type' => Reflection::TYPE_BAHAN_IBADAH,
            'body' => 'Isi bahan ibadah yang akan dibaca.',
        ]);

        $this->get(route('client.bahan-ibadah.detail', $bahan))
            ->assertOk()
            ->assertSee('Bahan Ibadah Lengkap')
            ->assertSee('Isi bahan ibadah yang akan dibaca.');

        $bahan->update(['status' => 'inactive']);
        $this->get(route('client.bahan-ibadah.detail', $bahan))->assertNotFound();

        $renungan = Reflection::create([
            'title' => 'Renungan Biasa',
            'date' => '2026-07-27',
            'status' => 'active',
            'type' => Reflection::TYPE_RENUNGAN,
        ]);

        $this->get(route('client.bahan-ibadah.detail', $renungan))->assertNotFound();
    }

    public function test_homepage_shows_latest_active_bahan_ibadah(): void
    {
        Reflection::create([
            'title' => 'Bahan Ibadah Lama',
            'date' => '2026-07-01',
            'status' => 'active',
            'type' => Reflection::TYPE_BAHAN_IBADAH,
        ]);
        Reflection::create([
            'title' => 'Bahan Ibadah Terbaru',
            'date' => '2026-08-09',
            'status' => 'active',
            'type' => Reflection::TYPE_BAHAN_IBADAH,
        ]);
        Reflection::create([
            'title' => 'Bahan Ibadah Nonaktif',
            'date' => '2026-08-16',
            'status' => 'inactive',
            'type' => Reflection::TYPE_BAHAN_IBADAH,
        ]);

        $this->get(route('client.home'))
            ->assertOk()
            ->assertSee('Bahan Ibadah')
            ->assertSee('Bahan Ibadah Terbaru')
            ->assertDontSee('Bahan Ibadah Nonaktif');
    }

    public function test_homepage_carousel_contains_renungan_and_bahan_ibadah(): void
    {
        Reflection::create([
            'title' => 'Renungan Carousel',
            'date' => '2026-08-01',
            'status' => 'active',
            'type' => Reflection::TYPE_RENUNGAN,
        ]);
        Reflection::create([
            'title' => 'Bahan Carousel',
            'date' => '2026-08-02',
            'status' => 'active',
            'type' => Reflection::TYPE_BAHAN_IBADAH,
        ]);

        $this->get(route('client.home'))
            ->assertOk()
            ->assertSee('Renungan Harian')
            ->assertSee('Renungan Carousel')
            ->assertSee('Bahan Carousel')
            ->assertSee('Lihat Semua Renungan')
            ->assertSee('Lihat Semua Bahan Ibadah');
    }

    public function test_homepage_hides_bahan_rohani_carousel_when_empty(): void
    {
        $this->get(route('client.home'))
            ->assertOk()
            ->assertDontSee('Lihat Semua Renungan');
    }

    public function test_renungan_page_does_not_show_bahan_ibadah(): void
    {
        Reflection::create([
            'title' => 'Bahan Ibadah Minggu',
            'date' => '2026-08-01',
            'status' => 'active',
            'type' => Reflection::TYPE_BAHAN_IBADAH,
        ]);

        $this->get(route('client.reflections'))
            ->assertOk()
            ->assertDontSee('Bahan Ibadah Minggu');
    }
}
