<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecipientFeatureTest extends TestCase
{
    /**
     * Test create a Recipient
     *
     * @return void
     */
    public function test_create()
    {
        $this->postJson('/api/recipients', ['email' => 'test22@example.com'])
            ->assertSuccessful()
                ->assertJsonStructure(['data', 'message', 'success']);

    }

    /**
     * Test Get Senders
     *
     * @return void
     */
    public function test_get_list()
    {
        $this->getJson('/api/recipients')
            ->assertSuccessful()
                ->assertJsonStructure(['data', 'message', 'success']);

    }
}
