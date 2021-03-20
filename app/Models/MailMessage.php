<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\MailMessage
 *
 * @property string $id
 * @property string $sender_id
 * @property string $recipient_id
 * @property string $subject
 * @property string|null $html_content
 * @property string $plain_content
 * @property array|null $attachments
 * @property string|null $status_log
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Recipient $recipient
 * @property-read \App\Models\Sender $sender
 * @method static \Illuminate\Database\Eloquent\Builder|MailMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MailMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MailMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|MailMessage whereAttachments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailMessage whereHtmlContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailMessage wherePlainContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailMessage whereRecipientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailMessage whereSenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailMessage whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailMessage whereStatusLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailMessage whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailMessage whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Database\Factories\MailMessageFactory factory(...$parameters)
 */
class MailMessage extends BaseModel
{

    use HasFactory;

    protected $fillable = [
        'sender_id',
        'recipient_id',
        'subject',
        'html_content',
        'plain_content',
        'status_log',
        'status'
    ];

    protected $casts = ['attachments' => 'array'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo(Sender::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipient()
    {
        return $this->belongsTo(Recipient::class);
    }
}
