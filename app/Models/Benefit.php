<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Benefit extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'discount',
    ];

    protected $dates = [
        'deleted_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($benefit) {
            $benefit->discount = $benefit->discount > 1 ? $benefit->discount / 100 : $benefit->discount;
        });
    }
}
