<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'filename',
        'path',
    ];

    /**
     * Scope a query to latest games.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('id', 'DESC');
    }
}
