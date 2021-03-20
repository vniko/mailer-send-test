<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_messages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('sender_id');
            $table->uuid('recipient_id');
            $table->string('subject');
            $table->longText('html_content')->nullable();
            $table->longText('plain_content');
            $table->text('attachments')->nullable();
            $table->text('status_log')->nullable();
            $table->string('status')->default('posted');
            $table->timestamps();

            $table->foreign('sender_id')->references('id')->on('senders');
            $table->foreign('recipient_id')->references('id')->on('recipients');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mail_messages');
    }
}
