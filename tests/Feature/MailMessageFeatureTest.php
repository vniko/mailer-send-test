<?php

namespace Tests\Feature;

use App\Models\Recipient;
use App\Models\Sender;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MailMessageFeatureTest extends TestCase
{
    /**
     * Test Create New Mail Message
     *
     * @return void
     */
    public function test_create()
    {
        $sender = Sender::inRandomOrder()->first();
        $rcpt = Recipient::inRandomOrder()->first();

        $response = $this->postJson('/api/mail_messages',
            [
                'sender_id' => $sender->id,
                'recipient_id' => $rcpt->id,
                'subject' => 'Some test subject',
                'plain_content' => 'Plain Content',
                'html_content' => '<b>HTML</b> content'
            ]
        );
        $response->assertSuccessful()
                    ->assertJsonStructure(['data', 'message', 'success']);

        $data = $response->json('data');

        $this->assertDatabaseHas('mail_messages', ['id' => $data['id']]);

    }

    /**
     * Test Get Mail Messages
     *
     * @return void
     */
    public function test_get_list()
    {
        $this->getJson('/api/mail_messages')
            ->assertSuccessful()
            ->assertJsonStructure(['data', 'message', 'success']);

    }
}
