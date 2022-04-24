<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected  $fillable =
        [
            'user_id' , 'wish_list'
        ] ;



    use HasFactory;


     public function customers ()
     {
         $this->belongsTo( User::class  );

     }
}

