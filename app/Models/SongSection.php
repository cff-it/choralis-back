<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SongSection extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['song_id', 'lyrics', 'type', 'position'];

    public function song(): BelongsTo
    {
        return $this->belongsTo(Song::class);
    }
}
