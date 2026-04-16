<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SongTheme extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['name'];

    public function songs(): BelongsToMany
    {
        return $this->belongsToMany(Song::class, 'song_song_theme');
    }
}
