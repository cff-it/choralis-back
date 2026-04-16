<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VoiceGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function voices(): HasMany
    {
        return $this->hasMany(Voice::class, 'vocal_group_id');
    }
}
