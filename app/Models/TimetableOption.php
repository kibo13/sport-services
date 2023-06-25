<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TimetableOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'day_of_week',
        'start',
        'duration',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Проверяет, находится ли указанный час в пределах продолжительности.
     *
     * @param string $hour Час для проверки
     * @return bool Результат проверки
     */
    public function isHourWithinDuration(string $hour): bool
    {
        $requestHour = date('H', strtotime($hour));
        $optionHour = date('H', strtotime($this->start));
        $difference = $requestHour - $optionHour;

        return $requestHour >= $optionHour && $difference < $this->duration;
    }
}
