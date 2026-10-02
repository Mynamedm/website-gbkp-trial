<?php

namespace Tests\Feature;

use App\Models\Reflection;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ReflectionCrudTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        $user = User::factory()->create();
        Role::findOrCreate('super_admin', 'web');
        $user->assignRole('super_admin');

        return $user;
    }

    public function test_admin_can_open_reflection_page(): void
    {
        $response = $this->actingAs($this->admin())->get(route('admin.reflections.index'));

        $response->assertOk();
        $response->assertSee('Daftar Renungan Harian');
        $response->assertSee('Tambah Renungan');
    }

    public function test_guest_is_redirected_from_reflection_admin_page(): void
    {
        $this->get(route('admin.reflections.index'))->assertRedirect(route('login'));
    }

    public function test_admin_can_create_reflection(): void
    {
        $response = $this->actingAs($this->admin())->post(route('admin.reflections.store'), [
            'title' => 'Tenanglah, Jangan Takut',
            'date' => '2026-08-09',
            'church_day' => 'Minggu Advent',
            'theme' => 'Tuhan Menemanimu',
            'bible_verse' => 'Matius 14 : 22 - 33',
            'bible_translation' => 'Terjemahan Baru',
            'excerpt' => 'Cuplikan renungan.',
            'body' => 'Isi renungan harian.',
            'status' => 'active',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('admin.reflections.index'));

        $reflection = Reflection::firstWhere('title', 'Tenanglah, Jangan Takut');

        $this->assertNotNull($reflection);
        $this->assertSame('tenanglah-jangan-takut', $reflection->slug);
        $this->assertSame('active', $reflection->status);
        $this->assertSame('Cuplikan renungan.', $reflection->excerpt);
    }

    public function test_create_requires_title_date_and_status(): void
    {
        $response = $this->actingAs($this->admin())->post(route('admin.reflections.store'), []);

        $response->assertSessionHasErrors(['title', 'date', 'status']);
        $this->assertSame(0, Reflection::count());
    }

    public function test_admin_can_update_reflection(): void
    {
        $reflection = Reflection::create([
            'title' => 'Judul Lama',
            'date' => '2026-08-01',
            'status' => 'active',
        ]);

        $response = $this->actingAs($this->admin())->put(route('admin.reflections.update', $reflection), [
            'title' => 'Judul Baru',
            'date' => '2026-08-08',
            'status' => 'inactive',
            'body' => 'Isi baru.',
        ]);

        $response->assertSessionHasNoErrors();

        $reflection->refresh();

        $this->assertSame('Judul Baru', $reflection->title);
        $this->assertSame('inactive', $reflection->status);
        $this->assertSame('Isi baru.', $reflection->body);
        $this->assertSame('2026-08-08', $reflection->date->toDateString());
    }

    public function test_admin_can_delete_reflection(): void
    {
        $reflection = Reflection::create([
            'title' => 'Akan Dihapus',
            'date' => '2026-08-01',
            'status' => 'active',
        ]);

        $response = $this->actingAs($this->admin())->delete(route('admin.reflections.destroy', $reflection));

        $response->assertSessionHasNoErrors();
        $this->assertNull($reflection->fresh());
    }

    public function test_public_reflection_list_only_shows_active_entries(): void
    {
        Reflection::create(['title' => 'Aktif', 'date' => '2026-08-01', 'status' => 'active']);
        Reflection::create(['title' => 'Nonaktif', 'date' => '2026-08-02', 'status' => 'inactive']);

        $this->get(route('client.reflections'))
            ->assertOk()
            ->assertSee('Aktif')
            ->assertDontSee('Nonaktif');
    }

    public function test_public_reflection_detail_uses_slug_and_hides_inactive(): void
    {
        $reflection = Reflection::create([
            'title' => 'Damai Sejahtera',
            'date' => '2026-07-26',
            'status' => 'active',
            'body' => 'Isi renungan yang akan dibaca.',
        ]);

        $this->get(route('client.reflections.detail', $reflection))
            ->assertOk()
            ->assertSee('Damai Sejahtera')
            ->assertSee('Isi renungan yang akan dibaca.');

        $reflection->update(['status' => 'inactive']);

        $this->get(route('client.reflections.detail', $reflection))->assertNotFound();
    }

    public function test_homepage_uses_latest_active_reflection(): void
    {
        Reflection::create(['title' => 'Lebih Lama', 'date' => '2026-07-01', 'status' => 'active']);
        Reflection::create(['title' => 'Renungan Terbaru', 'date' => '2026-08-09', 'status' => 'active']);

        $this->get(route('client.home'))
            ->assertOk()
            ->assertSee('Renungan Hari Ini')
            ->assertSee('Renungan Terbaru')
            ->assertSee(route('client.reflections.detail', 'renungan-terbaru'));
    }
}