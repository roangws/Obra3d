<?php

namespace App;

use App\Image;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['name', 'description', 'url','cover_id','playlist_id','user_id','is_public'];

    public function playlist(){
        return $this->belongsTo(Playlist::class,'playlist_id');
    }

    public function cover(){
        return $this->hasOne(Image::class, 'id','cover_id');
    }
}
