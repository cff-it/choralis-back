<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Libretto extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'color_one', 'color_two'];

    public function songs(): BelongsToMany
    {
        return $this->belongsToMany(Song::class, 'song_libretti')
                    ->withPivot('position')
                    ->orderByPivot('position');
    }
}
