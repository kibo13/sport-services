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
        'workload',
        'color',
    ];

    protected $dates = [
        'deleted_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($group) {
            $group->limit = 12;
        });

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

    public function options(): HasMany
    {
        return $this->hasMany(TimetableOption::class);
    }

    public function getTotalHours()
    {
        $totalHours = 0;

        foreach ($this->options as $option) {
            $totalHours += $option->duration;
        }

        return $totalHours;
    }

    public function getOptionByDayOfWeek($dayOfWeek)
    {
        // Возвращаем первый элемент коллекции `options`,
        // который удовлетворяет условию `day_of_week = $dayOfWeek`
        return $this->options->firstWhere('day_of_week', $dayOfWeek);
    }
}
