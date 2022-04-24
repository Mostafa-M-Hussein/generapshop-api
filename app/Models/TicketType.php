<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    protected  $fillable =['name'];


    use HasFactory;

public function tickets ()
{
    return $this->hasMany(Ticket::class ) ;

}

}
