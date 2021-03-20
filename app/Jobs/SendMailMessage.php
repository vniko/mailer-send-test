<?php

namespace App\Jobs;

use App\Enum\MailMessageStatus;
use App\Events\MessageHandled;
use App\Models\MailMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Message;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendMailMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var MailMessage
     */
    public $mailMessage;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(MailMessage $mailMessage)
    {
        $this->mailMessage = $mailMessage;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $mm = $this->mailMessage;
            Mail::send(['html' => 'emails.email', 'raw' => $mm->plain_content], ['content' => $mm->html_content], function ($message) use ($mm) {
                $message->from($mm->sender->email);
                $message->to($mm->recipient->email);
                $message->subject($mm->subject);
                if ($mm->attachments && count($mm->attachments)) {
                    foreach ($mm->attachments as $fname) {
                        $message->attach(\Storage::disk('attachments')->path($fname));
                    }
                }
            });

            if (Mail::failures()) {
                $this->mailMessage->status_log = json_encode(Mail::failures());
                $this->mailMessage->status = MailMessageStatus::failed()->getValue();
            } else {
                $this->mailMessage->status = MailMessageStatus::sent()->getValue();
            }

            $this->mailMessage->save();

        } catch (\Exception $e) {

            $this->mailMessage->status_log = json_encode(['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            $this->mailMessage->status = MailMessageStatus::failed()->getValue();
            $this->mailMessage->save();

        } finally {
            broadcast(new MessageHandled($this->mailMessage->id, $this->mailMessage->status));
        }
    }
}
