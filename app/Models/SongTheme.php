<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Carbon\Carbon;

/**
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class SongTheme extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['name'];

    public function songs(): BelongsToMany
    {
        return $this->belongsToMany(Song::class, 'song_song_theme');
    }
}
