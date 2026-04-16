<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MassRoleAssignment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'mass_id', 'mass_role_id', 'notes'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function mass(): BelongsTo
    {
        return $this->belongsTo(Mass::class);
    }

    public function massRole(): BelongsTo
    {
        return $this->belongsTo(MassRole::class);
    }
}
