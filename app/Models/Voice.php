<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Voice extends Model
{
    use HasFactory;

    protected $fillable = ['vocal_group_id', 'name', 'vocal_range'];

    public function voiceGroup(): BelongsTo
    {
        return $this->belongsTo(VoiceGroup::class, 'vocal_group_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
