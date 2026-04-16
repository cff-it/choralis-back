<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'date_start', 'date_end', 'need_payment', 'payment_amount'];

    protected function casts(): array
    {
        return [
            'date_start'    => 'datetime',
            'date_end'      => 'datetime',
            'need_payment'  => 'boolean',
        ];
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(EventSubscription::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(EventPayment::class);
    }

    public function checks(): HasMany
    {
        return $this->hasMany(EventCheck::class);
    }
}
