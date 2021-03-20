<?php

namespace Database\Factories;

use App\Models\MailMessage;
use App\Models\Recipient;
use App\Models\Sender;
use Illuminate\Database\Eloquent\Factories\Factory;

class MailMessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MailMessage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sender = Sender::inRandomOrder()->first();
        $rcpt = Recipient::inRandomOrder()->first();

        return [
            'sender_id' => $sender->id,
            'recipient_id' => $rcpt->id,
            'subject' => $this->faker->text(100),
            'plain_content' => $this->faker->text(300),
            'html_content' => $this->faker->text(300),
            'status' => \Arr::random(['posted', 'sent', 'failed'])
        ];
    }
}
