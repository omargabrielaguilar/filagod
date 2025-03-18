<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/** @package App\Models */
class Episode extends Model
{
    /** @use HasFactory<\Database\Factories\EpisodeFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    /** @return BelongsTo  */
    public function podcast(): BelongsTo
    {
        return $this->belongsTo(Podcast::class);
    }

    /** @return HasMany  */
    public function listeningParties(): HasMany
    {
        return $this->hasMany(ListeningParty::class);
    }
}
