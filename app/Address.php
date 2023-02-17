<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'street', 'number', 'complement', 'zipcode', 'city', 'state', 'neighborhood'
    ];

    public function users()
    {
        return $this->hasOne(User::class);
    }

    public function companies()
    {
        return $this->hasOne(Company::class);
    }

    public function construction()
    {
        return $this->hasOne(Construction::class);
    }
}
