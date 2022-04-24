<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable =
        [
            'product_id', 'url'
        ];
    use HasFactory;




    public  function prodcut()
    {
        return $this->belongsTo(Product::class )  ;

    }
}
