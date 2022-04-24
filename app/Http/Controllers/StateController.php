<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index()
    {
        $states = State::with(['country'])->paginate(env('pagination_count'));
        return view('admin.states.states')->with(
            [
                'states' => $states
            ]);
    }
}
