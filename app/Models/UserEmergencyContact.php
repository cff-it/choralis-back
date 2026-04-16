<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserEmergencyContact extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['user_id', 'contact_name', 'contact_phone'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
