<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chip extends Model
{
    protected $fillable = ['name', 'user_id', 'media_id'];
}
