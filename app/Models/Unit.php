<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected  $fillable =
        [
            'unit_code' , 'unit_name'
        ];

    use HasFactory;

    public function products ()
    {
        return $this->hasMany(Product::class , 'id' , 'unit') ;

    }

    public function formatted ()
    {
        return $this->unit_name.'-'.$this->unit_code  ;

    }

}
