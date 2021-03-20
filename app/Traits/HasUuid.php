<?php


namespace App\Traits;


use Illuminate\Support\Str;

trait HasUuid
{
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}
