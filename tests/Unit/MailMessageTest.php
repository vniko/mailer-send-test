<?php

namespace Tests\Unit;

use App\Jobs\SendMailMessage;
use App\Models\MailMessage;
use App\Models\Recipient;
use App\Models\Sender;
use App\Repositories\MailMessageRepository;
use Illuminate\Mail\Mailable;
use Tests\TestCase;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Mail;


class MailMessageTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create()
    {

        $this->expectsJobs(SendMailMessage::class);

        $repo = resolve(MailMessageRepository::class);
        $faker = resolve(Faker::class);

        $senders = Sender::factory(1)->create();
        $rcpts = Recipient::factory(1)->create();


        $messageObj = $repo->create(
            [
                'sender_id' => $senders->first()->id,
                'recipient_id' => $rcpts->first()->id,
                'subject' => $faker->text(100),
                'plain_content' => $faker->text(300),
                'html_content' => $faker->text(300),
                'status' => \Arr::random(['posted', 'sent', 'failed'])
            ]
        );

        $this->assertDatabaseHas('mail_messages', ['id' => $messageObj->id]);

    }

}
