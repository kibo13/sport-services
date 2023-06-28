<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'activity_id',
        'specialization_id',
        'trainer_id',
        'start',
        'end',
        'init',
        'place',
        'note',
    ];

    protected $dates = [
        'deleted_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($event) {
            $event->activity_id = $event->specialization_id;
            $event->end = $event->start;
        });

        static::created(function ($event) {
            $event->initializeEventResults();
        });
    }

    protected function initializeEventResults()
    {
        for ($position = 1; $position <= 3; $position++) {
            EventResult::query()->create([
                'event_id' => $this->id,
                'position' => $position,
            ]);
        }
    }

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

    public function specialization(): BelongsTo
    {
        return $this->belongsTo(Specialization::class);
    }

    public function trainer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function results(): HasMany
    {
        return $this->hasMany(EventResult::class);
    }
}
