<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Engine extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function games()
    {
        return $this->hasMany(Game::class);
    }
}
