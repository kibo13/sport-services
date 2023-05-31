<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'visit_id',
        'activity_id',
        'service_id',
        'client_id',
        'amount',
        'is_paid',
    ];

    protected $dates = [
        'deleted_at'
    ];
}
