<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Construction extends Model
{
    protected $fillable = ["name", "description", "phone", "company_id", "address_id", "user_id", "cover_id"];


    protected $dates = ['created_at', 'deleted_at'];

    use SoftDeletes;


    public function getCreatedAtAttribute($date)
    {

        return Carbon::parse($date)->format("d/m/Y H:i");
    }

    public function cover()
    {
        return $this->hasOne(Image::class, 'id', 'cover_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }
}
