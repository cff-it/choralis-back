<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MassSongSection extends Model
{
    use HasFactory;

    protected $fillable = ['mass_song_id', 'song_section_id', 'position'];

    public function massSong(): BelongsTo
    {
        return $this->belongsTo(MassSong::class);
    }

    public function songSection(): BelongsTo
    {
        return $this->belongsTo(SongSection::class);
    }
}
