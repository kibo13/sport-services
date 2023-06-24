<?php

namespace App\Models;


use App\Enums\Role as RoleEnum;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'role_id',
        'benefit_id',
        'education_id',
        'name',
        'surname',
        'patronymic',
        'birthday',
        'phone',
        'email',
        'photo',
        'address',
        'password',
        'is_notify',
        'experience',
        'note',
        'certificate',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'deleted_at'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->role_id  = $user->role_id ?? RoleEnum::CLIENT;
            $user->password = Hash::make('secret');
        });

        static::created(function ($user) {
            if ($user->isClient()) {
                MedicalCard::query()->create(['client_id' => $user->id]);
            }
        });

        static::saving(function ($user) {
            $user->short_name   = $user->getShortName($user);
            $user->full_name    = "$user->surname $user->name $user->patronymic";
            $user->surname_name = "$user->surname $user->name";
            $user->phone        = format_phone_number_for_storage($user->phone);
            $user->age          = $user->birthday ? $user->calculateAge($user->birthday) : null;
            $user->deleteCertificateIfNoBenefit();
        });
    }

    protected function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
    }

    protected function setSurnameAttribute($value)
    {
        $this->attributes['surname'] = ucfirst($value);
    }

    protected function calculateAge(string $birthday): int
    {
        $parsedBirthday = Carbon::parse($birthday);
        $currentDate    = Carbon::now();

        return $currentDate->diffInYears($parsedBirthday);
    }

    protected function getShortName(User $user): string
    {
        return $user->patronymic
            ? $user->surname . ' ' . mb_substr($user->name, 0, 1) . '.' . mb_substr($user->patronymic, 0, 1) . '.'
            : $user->surname . ' ' . mb_substr($user->name, 0, 1) . '.';
    }

    protected function deleteCertificateIfNoBenefit()
    {
        if (is_null($this->benefit_id) && $this->certificate) {
            $filePath = $this->certificate;

            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            $this->benefit_id = null;
            $this->certificate = null;
        }
    }

    public function isOwner(): bool
    {
        return $this->role_id === RoleEnum::OWNER;
    }

    public function isAdmin(): bool
    {
        return $this->role_id === RoleEnum::ADMIN;
    }

    public function isPaymaster(): bool
    {
        return $this->role_id === RoleEnum::PAYMASTER;
    }

    public function isMethodist(): bool
    {
        return $this->role_id === RoleEnum::METHODIST;
    }

    public function isClient(): bool
    {
        return $this->role_id === RoleEnum::CLIENT;
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function benefit(): BelongsTo
    {
        return $this->belongsTo(Benefit::class);
    }

    public function education(): BelongsTo
    {
        return $this->belongsTo(Education::class);
    }

    public function specializations(): BelongsToMany
    {
        return $this->belongsToMany(Specialization::class);
    }

    public function places(): HasMany
    {
        return $this->hasMany(Place::class, 'client_id');
    }

    public function medical_card(): HasOne
    {
        return $this->hasOne(MedicalCard::class, 'client_id');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermission(...$permissions): bool
    {
        foreach ($permissions as $permission) {
            if ($this->permissions->contains('slug', $permission)) {
                return true;
            }
        }
        return false;
    }
}
