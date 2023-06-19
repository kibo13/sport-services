<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'medical_history',
        'allergies',
        'medications',
        'cardiovascular_system',
        'respiratory_system',
        'mobility',
        'doctor_recommendations',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}
