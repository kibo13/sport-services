<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialization extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'note',
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function trainers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'specialization_user', 'specialization_id', 'user_id');
    }
}
