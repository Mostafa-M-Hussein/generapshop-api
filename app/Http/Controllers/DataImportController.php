<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Table;

class DataImportController extends Controller
{
    public function importUnit()
    {
        $units = [


            'BG' => 'Bag',
            'BA' => 'Bale',
            'BI' => 'Bar',
            'BR' => 'Barrel',
            'BL' => 'Block',
            'B8' => 'Board',
            'BF' => 'Board Feet',
            'BO' => 'Bottle',
            'BX' => 'Box',
            'BN' => 'Bulk',
            'BD' => 'Bundle',
            'BU' => 'Bushel',
            'CN' => 'Can',
            'CG' => 'Card',
            'CT' => 'Carton',
            'CQ' => 'Cartridge'
        ];


        foreach (  $units as $key => $value  )
        {
            DB::table('units')->insert(
                [
                    'unit_code' => $key ,
                    'unit_name' => $value ,
                    'created_at' => now() ,
                    'updated_at' => now()  ,

                ] ) ;


        }



    }


}
