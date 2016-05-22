<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use App;

use Auth;

class BandController extends Controller
{

    $required = [
        'time' => 'required',
        'place' => 'required',
        'description' => 'required',
    ]

    public function store(Request $request)
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
        $band = App\Band::where('id',$id)->firstOrFail();
        return response()->json($band);
    }

    public function join(Request $request, $id)
    {
        $user = Auth::user();
        if(App\Bandmember::where('user_id',$user->id)->where('band_id',$id)->first() === null )
        {
            return response()->json(['status' => 'error','message' => 'user already join']);
        }
        else if(App\Reqjoin::where('user_id',$user->id)->where('band_id',$id)->first() === null)
        {
            return response()->json(['status' => 'error','message' => 'user in waiting list']);
        }

        $reqjoin = new App\Reqjoin;
        $reqjoin->user_id = $user->id;
        $reqjoin->band_id = $id;
        $reqjoin->status = 0;
        $reqjoin->description = $request->description;
        $reqjoin->save();

        return response()->json(['status' => 'success','message' => 'success insert in data request join']);
    }

    public function list($id)
    {
        $list = App\Bandmember::where('band_id',$id)->firstOrFail();
        return response()->json($list);
    }
}
