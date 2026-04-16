<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mass extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'liturgical_name', 'prayer_cycle', 'notes', 'is_public'];

    protected function casts(): array
    {
        return [
            'date'      => 'date',
            'is_public' => 'boolean',
        ];
    }

    public function parts(): HasMany
    {
        return $this->hasMany(MassPart::class);
    }

    public function roleAssignments(): HasMany
    {
        return $this->hasMany(MassRoleAssignment::class);
    }
}
