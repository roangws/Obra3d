<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name'];


    public function address(){
        return $this->hasOne(Address::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
