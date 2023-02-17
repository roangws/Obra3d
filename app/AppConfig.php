<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppConfig extends Model
{
    protected $fillable = [
        'description', 'welcome_video_url'
    ];
}
