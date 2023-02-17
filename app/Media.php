<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['name', 'description', 'image_id', 'inspection_id', 'category'];
}
