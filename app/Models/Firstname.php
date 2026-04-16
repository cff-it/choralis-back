<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Firstname extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'first_name', 'order', 'default'];

    protected function casts(): array
    {
        return ['default' => 'boolean'];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
