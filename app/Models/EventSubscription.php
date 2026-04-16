<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventSubscription extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'event_id', 'subscribed_at', 'has_paid', 'paid_at'];

    protected function casts(): array
    {
        return [
            'subscribed_at' => 'datetime',
            'has_paid'      => 'boolean',
            'paid_at'       => 'datetime',
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
