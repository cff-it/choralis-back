<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSacrament extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'place', 'spouse_name', 'spouse_is_member'];

    protected function casts(): array
    {
        return [
            'date'             => 'date',
            'spouse_is_member' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
