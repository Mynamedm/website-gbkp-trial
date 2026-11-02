<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomepageMapTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_map_uses_place_search_when_api_key_is_empty(): void
    {
        config()->set('services.google_maps.key', null);

        $this->get(route('client.home'))
            ->assertOk()
            ->assertSee('https://maps.google.com/maps?', false)
            ->assertSee('q=GBKP%20Bandar%20Lampung', false)
            ->assertSee('output=embed', false)
            ->assertDontSee('!2d105.2!3d-5.4', false);
    }

    public function test_homepage_map_uses_embed_api_when_api_key_is_configured(): void
    {
        config()->set('services.google_maps.key', 'test-key');

        $this->get(route('client.home'))
            ->assertOk()
            ->assertSee('https://www.google.com/maps/embed/v1/place?', false)
            ->assertSee('key=test-key', false)
            ->assertSee('q=GBKP%20Bandar%20Lampung', false)
            ->assertDontSee('!2d105.2!3d-5.4', false);
    }
}
