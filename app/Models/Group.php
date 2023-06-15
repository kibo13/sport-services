<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'activity_id',
        'trainer_id',
    ];

    protected $dates = [
        'deleted_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($group) {
            $group->initializePlaces();
        });
    }

    protected function initializePlaces()
    {
        for ($place = 1; $place <= $this->limit; $place++) {
            Place::query()->create([
                'group_id' => $this->id,
                'number' => $place,
            ]);
        }
    }

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

    public function trainer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function places(): HasMany
    {
        return $this->hasMany(Place::class);
    }
}
