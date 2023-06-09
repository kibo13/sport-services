<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'subject',
        'activity_id',
        'client_id',
        'trainer_id',
        'executor_id',
        'status_id',
        'message',
        'comment',
    ];

    protected $dates = [
        'deleted_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $authorizedUser = auth()->user();
            $order->status_id = 1;
            $order->client_id = $authorizedUser->isClient() ? $authorizedUser->id : null;
        });

        static::updating(function ($order) {
            $authorizedUser = auth()->user();

            if ($authorizedUser->isAdmin() && is_null($order->executor_id)) {
                $order->executor_id = $authorizedUser->id;
            }
        });
    }

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function trainer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function executor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'executor_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class, 'status_id');
    }
}
