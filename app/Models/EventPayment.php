<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EventPayment extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'name', 'amount', 'description'];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function userPayments(): HasMany
    {
        return $this->hasMany(UserPayment::class);
    }
}
