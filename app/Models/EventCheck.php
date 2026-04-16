<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventCheck extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'event_id', 'date_in', 'date_out'];

    protected function casts(): array
    {
        return [
            'date_in'  => 'datetime',
            'date_out' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
