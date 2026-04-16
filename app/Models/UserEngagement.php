<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserEngagement extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'adhesion_date', 'engagement_date', 'engagement_place'];

    protected function casts(): array
    {
        return [
            'adhesion_date'   => 'date',
            'engagement_date' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
