<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Sender::factory(10)->create();
        \App\Models\Recipient::factory(10)->create();

        \App\Models\MailMessage::factory(10)->create();

    }
}
