<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class MassPartType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function massParts(): HasMany
    {
        return $this->hasMany(MassPart::class);
    }
}
