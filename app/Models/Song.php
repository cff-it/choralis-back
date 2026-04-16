<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Song extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['title', 'author', 'reference', 'notes'];

    public function themes(): BelongsToMany
    {
        return $this->belongsToMany(SongTheme::class, 'song_song_theme');
    }

    public function libretti(): BelongsToMany
    {
        return $this->belongsToMany(Libretto::class, 'song_libretti')
                    ->withPivot('position')
                    ->orderByPivot('position');
    }

    public function sections(): HasMany
    {
        return $this->hasMany(SongSection::class)->orderBy('position');
    }

    public function links(): HasMany
    {
        return $this->hasMany(SongLink::class);
    }

    public function massSongs(): HasMany
    {
        return $this->hasMany(MassSong::class);
    }
}
