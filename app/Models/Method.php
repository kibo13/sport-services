<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Method extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'activity_id',
        'number',
        'note',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }
}
