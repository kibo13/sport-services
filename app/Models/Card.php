<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
        'service_id',
    ];

    protected $dates = [
        'deleted_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($card) {
            $card->start = date('Y-m-d');
            $card->end   = date('Y-m-d', strtotime('+1 month'));
        });
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
