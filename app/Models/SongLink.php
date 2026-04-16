<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SongLink extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['song_id', 'link_id', 'url'];

    public function song(): BelongsTo
    {
        return $this->belongsTo(Song::class);
    }

    public function linkType(): BelongsTo
    {
        return $this->belongsTo(LinkType::class, 'link_id');
    }
}
