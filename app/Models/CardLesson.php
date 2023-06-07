<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardLesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_id',
        'number',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($lesson) {
            if ($lesson->is_attended && is_null($lesson->attended_at)) {
                $lesson->attended_at = date('Y-m-d');
            }
        });
    }
}
