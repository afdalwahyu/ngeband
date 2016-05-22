<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User

use Validator;

class UserController extends Controller
{

    $required = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required',
        'location' => 'required',
        'instrument' => 'required',
        'genre' => 'required',
    ]

    public function store(Requests $request)
    {
        $validator = Validator::make($request->all(), $required);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->location = $request->location;
        $user->instrument = $request->instrument;
        $user->genre = $request->genre;
        $user->save();

        return response()->json(['status' => 'success','message' => 'success insert data']);

    }

    public function showProfile()
    {
        $user = Auth::user();
        return response()->json($user);
    }

    public function updateProfile(Requests $request)
    {
        $olduser = Auth::user();
        $validator = Validator::make($request->all(), $required);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $user = User::find($olduser->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->location = $request->location;
        $user->instrument = $request->instrument;
        $user->genre = $request->genre;
        $user->save();

        return response()->json(['status' => 'success','message' => 'success update data']);
    }

    public function showBand()
    {
        $user = Auth::user();
        $band = App\Band::where('user_id',$user->id);
        return response()->json($band);
    }

    public function pending()
    {
        $user = Auth::user();
        $friend = App\Friend::where('user_id_response',$user->id)->where('status',0)->firstOrFail();
        return response()->json($friend);
    }

    public function updateFriend(Requests $request, $id, $code)
    {
        $user = Auth::user();
        $friendreq = App\Friend::where('user_id_response', $user->id)->where('user_id_action',$id)->firstOrFail();
        $friendreq->status = $code;
        $friendreq->save();
        return response()->json(['status' => 'success','message' => 'success update friend']);
    }

    public function updateBand(Requests $request, $id, $friendid, $code)
    {
        $user = Auth::user();
        $band = App\Band::where('id',$id)->where('user_id',$user->id)->firstOrFail();
        $reqjoin = App\Reqjoin::where('band_id',$band->id)->where('user_id',$friendid)->firstOrFail();
        //update or insert part
        if($code == 1)
        {
            $bandmember = new App\Bandmember;
            $bandmember->user_id = $friendid;
            $bandmember->band_id = $band->id;
            $bandmember->save();

            $reqjoin->status = 1;
            $reqjoin->save();
        }
        if ($code == 2) 
        {
            $reqjoin->status = 2;
            $reqjoin->save();           
        }
        return response()->json(['status' => 'success','message' => 'success modify data band request']);
    }

}
