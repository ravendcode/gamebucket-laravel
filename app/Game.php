<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Game extends Model
{
    protected $fillable = [
        'title',
        'filename',
        'path',
        'visible',
    ];

    public static function latest(): Collection
    {
        return Game::where('visible', true)->orderBy('id', 'DESC')->get();
    }
}
