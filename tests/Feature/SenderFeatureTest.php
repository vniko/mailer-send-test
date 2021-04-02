<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SenderFeatureTest extends TestCase
{
    /**
     * Test create a Sender
     *
     * @return void
     */
    public function test_create()
    {
        $this->postJson('/api/senders', ['email' => 'test@example.com'])
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
        $this->getJson('/api/senders')
            ->assertSuccessful()
                ->assertJsonStructure(['data', 'message', 'success']);

    }
}
