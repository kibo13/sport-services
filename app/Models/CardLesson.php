<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CardLesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_id',
        'number',
        'is_attended',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($lesson) {
            if ($lesson->is_attended && is_null($lesson->attended_at)) {
                $lesson->attended_at = date('Y-m-d');
            }
        });

        static::updated(function ($lesson) {
            $card = $lesson->card;
            $remainingLessonsCount = $card->getRemainingLessonsCount();
            if ($remainingLessonsCount === 0) {
                $card->update(['is_active' => false]);
            }
        });
    }

    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }
}
