<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Test that all key public routes load successfully.
     */
    public function test_artists_page_loads(): void
    {
        $this->get(route('artists'))->assertOk();
    }

    public function test_artist_show_page_loads(): void
    {
        $this->get(route('artists.show', 'dharam-sahu'))->assertOk();
    }

    public function test_portfolio_page_loads(): void
    {
        $this->get(route('portfolio'))->assertOk();
    }

    public function test_pricing_page_loads(): void
    {
        $this->get(route('pricing'))->assertOk();
    }

    public function test_booking_create_page_loads(): void
    {
        $this->get(route('booking.create'))->assertOk();
    }
}
