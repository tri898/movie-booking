<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Plank\Mediable\Media as MediaAlias;

class Media extends MediaAlias
{
    use HasFactory;
    /**
     * Scope a query to only include file name medias.
     */
    public function scopeFileName(Builder $query, string $filename = null): void
    {
        $query->where('filename', 'LIKE', '%' . $filename . '%');
    }

    /**
     * Scope a query to only include file name medias.
     */
    public function scopeAggregateType(Builder $query, string $aggregateType = null): void
    {
        if ($aggregateType) {
            $query->where('aggregate_type', '=', $aggregateType);
        }
    }
}
