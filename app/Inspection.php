<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    protected $fillable = ['name', 'description', 'construction_id','author_id','cover_id','inspection_date'];

    public function author(){
        return $this->belongsTo(User::class, 'author_id');
    }

    public function construction(){
        return $this->belongsTo(Construction::class);
    }

    public function cover(){
        return $this->belongsTo(Image::class,'cover_id');
    }
}
