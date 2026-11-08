<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_navigation_links_to_all_required_pages(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('href="' . route('welcome') . '"', false)
            ->assertSee('href="' . route('tasks.index') . '"', false)
            ->assertSee('href="' . route('profile') . '"', false)
            ->assertSee('href="' . route('about') . '"', false);
    }
}
