<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User

class BandController extends Controller
{

    $required = [
        'time' => 'required',
        'place' => 'required',
        'description' => 'required',
    ]

    public function store(Requests $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), $required);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $band = new App\Band;
        $band->user_id = $user->id;
        $band->time = $request->time;
        $band->place = $request->place;
        $band->description = $request->description;
        $band->save();

        return response()->json(['status' => 'success','message' => 'success insert data']);
    }

    public function show($id)
    {

    }

    public function join(Requests $request, $id)
    {

    }

    public function list($id)
    {

    }
}
