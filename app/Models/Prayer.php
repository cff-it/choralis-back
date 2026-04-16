<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prayer extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['title', 'content'];

    public function massParts(): HasMany
    {
        return $this->hasMany(MassPart::class);
    }
}
