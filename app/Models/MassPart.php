<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MassPart extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['mass_id', 'mass_part_type_id', 'prayer_id', 'antiphon'];

    public function mass(): BelongsTo
    {
        return $this->belongsTo(Mass::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(MassPartType::class, 'mass_part_type_id');
    }

    public function prayer(): BelongsTo
    {
        return $this->belongsTo(Prayer::class);
    }

    public function massSongs(): HasMany
    {
        return $this->hasMany(MassSong::class);
    }
}
