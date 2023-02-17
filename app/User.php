<?php

namespace App;

use Carbon\Carbon;
use App\Construction;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Socialite\Two\User as SocialiteUser;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function __construct(
        array $attributes = [],
        SocialiteUser $socialiteUser = null
    ) {
        parent::__construct($attributes);
        $socialiteUser === null
            ?: $this->prepareUserBySocialite($socialiteUser);
    }
    protected $fillable = [
        'name', 'email', 'password', 'lastname', 'phone', 'company_id', 'address_id', 'profile_id', 'is_administrator','picture_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = ['created_at'];

    public function getCreatedAtAttribute($date){
    
        return Carbon::parse($date)->format("d/m/Y");
    }


    public function constructions()
    {
        return $this->hasMany(Construction::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }


    public function hashPassword(string $password): User
    {
        $this->password = Hash::make($password);
        return $this;
    }

    public function revokeToken(): User
    {
        $this->api_token = null;
        return $this;
    }

    public function createToken(): User
    {
        $this->api_token = str_random(60);
        return $this;
    }

    private function prepareUserBySocialite($social): void
    {
        $this->name = $social->name;
        $this->email = $social->email;
        $this->hashPassword($social->email . $social->id);
        $this->createToken();
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'auth_by')->latest();
    }

    public function picture(){
        return $this->hasOne(Image::class, 'id', 'picture_id');
    }
}
