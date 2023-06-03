<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'activity_id',
        'service_id',
        'client_id',
        'amount',
    ];

    protected $dates = [
        'deleted_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($payment) {
            if (! $payment->paid_at) {
                $payment->paid_at = date('Y-m-d');
            }
        });
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}
