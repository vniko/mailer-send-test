<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Recipient
 *
 * @property string $id
 * @property string $email
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient query()
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Recipient extends BaseModel
{

    use HasFactory;

    protected $fillable = ['email'];
}
