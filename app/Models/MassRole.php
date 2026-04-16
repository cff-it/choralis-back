<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class MassRole extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function assignments(): HasMany
    {
        return $this->hasMany(MassRoleAssignment::class);
    }
}
