<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UnitController extends Controller
{


    private function unitNameExists($unitName)
    {

        $unit = Unit::where(

            'unit_name', '=', $unitName
        )->first();

        return $unit ? true : false;


    }


    private function unitCodeExists($unitCode)
    {

        $unit = Unit::where(

            'unit_code', '=', $unitCode
        )->first();

        return $unit ? true : false;


    }

    public function store(Request $request)
    {


        $request->validate(
            [
                'unit_name' => 'required',
                'unit_code' => 'required',

            ]);


        $unitName = $request->input('unit_name');
        $unitCode = $request->input('unit_code');
        if ($this->unitNameExists($unitName)) {
            Session::flash('message', 'Unit Name already exists  (' . $unitName . ') ');
            return redirect()->back();

        }
        if ($this->unitCodeExists($unitCode)) {
            Session::flash('message', 'Unit Code  already exists (' . $unitCode . ') ');
            return redirect()->back();
        }

        $unit = new  Unit();
        $unit->unit_name = $unitName;
        $unit->unit_code = $unitCode;
        $unit->save();

        Session::flash('message', 'Unit ' . $unit->unit_name . ' has been added ');
        return redirect()->back();


    }


    public function index()
    {
        $units = Unit::orderBy('unit_code')->paginate(15);
        return view('admin.units.units')->with([
            'units' => $units,
            'showLinks' => true,

        ]);

    }

    public function delete(Request $request)
    {
        if (is_null($request->input('unit_id')) || empty($request->input('unit_id')))
            Session::flash("message", "Unit is Required ");


        $request->validate(
            [
                'unit_id' => 'required'
            ]);

        $id = $request->input('unit_id');
        Unit::destroy($id);
        Session::flash('message', 'Unit has been deleted');
        return redirect()->back();


    }


    public function update(Request $request)
    {

        $request->validate([
            'unit_code' => 'required',
            'unit_id' => 'required',
            'unit_name' => 'required'

        ]);


        $unitId = intval($request->input('unit_id'));

        $unit = Unit::find($unitId);


        $unit->unit_name = $request->input('unit_name');
        $unit->unit_code = $request->input('unit_code');
        $unit->save();
        Session::flash('message', 'Unit ' . $unit->unit_name . ' Has been updated');
        return redirect()->back();

    }


    public function search(Request $request)
    {

        $request->validate([
            'unit_search' => 'required',
        ]);
        $searchTerm = $request->input('unit_search');
        $units = Unit::where(
            'unit_name', 'LIKE', '%' . $searchTerm . '%'
        )->orWhere('unit_name', 'LIKE', '%' . $searchTerm . '%')->get();
        if (count($units) > 0)
            return view('admin.units.units')->with(['units' => $units
                , 'showLinks' => false,
            ]);
        Session::flash('message', 'Nothing Found  :( ');
        return redirect()->back();


    }

}
