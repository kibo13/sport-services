<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
        'activity_id',
        'service_id',
        'payment_id',
        'is_active',
    ];

    protected $dates = [
        'deleted_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($card) {
            $card->start = is_null($card->start) ? date('Y-m-d') : $card->start;
            $card->end   = is_null($card->end) ? date('Y-m-d', strtotime('+1 month')) : $card->end;
        });

        static::created(function ($card) {
            $card->initializeCardLessons();
        });
    }

    protected function initializeCardLessons()
    {
        for ($lesson = 1; $lesson <= 12; $lesson++) {
            CardLesson::query()->create([
                'card_id' => $this->id,
                'number'  => $lesson
            ]);
        }
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(CardLesson::class);
    }
}
