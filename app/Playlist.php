<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $fillable = ['name', 'description'];

    public function videos(){
        return $this->hasMany(Video::class);
    }
}
