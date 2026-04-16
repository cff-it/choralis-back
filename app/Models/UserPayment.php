<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPayment extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'event_payment_id',
        'paid_amount',
        'amount_due',
        'comment',
        'is_cancelled',
        'is_done',
    ];

    protected function casts(): array
    {
        return [
            'is_cancelled' => 'boolean',
            'is_done'      => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function eventPayment(): BelongsTo
    {
        return $this->belongsTo(EventPayment::class);
    }
}
