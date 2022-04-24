<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'mobile',
        'mobile_verified',
        'shiping_address',
        'biling_address',
    ];

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function orders()
    {

        return $this->hasMany(Order::class);

    }

    public function payment()
    {
        $this->hasMany(Payment::class);
    }

    public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }


    public function shippingAddress()
    {
        return $this->hasOne(Address::class, 'id', 'shipping_address');
    }

    public function bilingAddress()
    {
        return $this->hasOne(Address::class, 'id', 'biling_address');

    }


    public function wishList()
    {
        $this->hasOne(WishList::class);

    }


    public function reviews()
    {
        return $this->hasMany(Review::class );


    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);

    }

    public function FormatedName()
    {

        if ( property_exists($this ,  'first_name') )
            return "yes" ;
            return $this->first_name . ' ' . $this-> last_name;




    }

}
