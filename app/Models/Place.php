<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'client_id',
        'number',
        'is_busy',
        'busy_at',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($place) {
            if ($place->is_busy && is_null($place->busy_at)) {
                $place->busy_at = date('Y-m-d');
            }
        });
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}
