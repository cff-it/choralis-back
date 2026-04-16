<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    protected $fillable = [
        'mail',
        'last_name',
        'nick_name',
        'facebook_id',
        'token',
        'voice_id',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // Sanctum utilise `mail` comme champ d'email
    public function getEmailForPasswordReset(): string
    {
        return $this->mail;
    }

    public function voice(): BelongsTo
    {
        return $this->belongsTo(Voice::class);
    }

    public function firstnames(): HasMany
    {
        return $this->hasMany(Firstname::class)->orderBy('order');
    }

    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    public function sacrament(): HasOne
    {
        return $this->hasOne(UserSacrament::class);
    }

    public function engagement(): HasOne
    {
        return $this->hasOne(UserEngagement::class);
    }

    public function emergencyContacts(): HasMany
    {
        return $this->hasMany(UserEmergencyContact::class);
    }

    public function massRoleAssignments(): HasMany
    {
        return $this->hasMany(MassRoleAssignment::class);
    }

    public function eventSubscriptions(): HasMany
    {
        return $this->hasMany(EventSubscription::class);
    }

    public function eventChecks(): HasMany
    {
        return $this->hasMany(EventCheck::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(UserPayment::class);
    }
}
