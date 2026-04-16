<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LinkType extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['name'];

    public function songLinks(): HasMany
    {
        return $this->hasMany(SongLink::class, 'link_id');
    }
}
