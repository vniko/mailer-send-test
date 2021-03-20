<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Sender
 *
 * @property string $id
 * @property string $email
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Sender newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sender newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sender query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sender whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sender whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sender whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sender whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sender whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Sender extends BaseModel
{
    use HasFactory;

    protected $fillable = ['email'];
}
