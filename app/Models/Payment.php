<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable =
        [
            'amount', 'user_id', 'order_id', 'pain_on', 'payment_reference'
        ];
    use HasFactory;


    public function customer()
    {

        return $this->belongsTo(User :: class);

    }

    public function order()
    {
        return $this->belongsTo(Order::class);

    }

}
