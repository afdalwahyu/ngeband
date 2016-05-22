<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use App;

use Auth;

use DB;

use Validator;

class UserController extends Controller
{

    public $required = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required',
        'location' => 'required',
        'instrument' => 'required',
        'genre' => 'required',
    ];

    public function store(Request $request)
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

    public function updateProfile(Request $request)
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
        $friend = DB::select('
            select u1.name as name_act, u2.name as name_resp, 
            friend.user_id_action,friend.user_id_response,
            friend.status,friend.description from friend 
            inner join users u1 on u1.id = friend.user_id_action 
            inner join users u2 on u2.id = friend.user_id_response
            where (user_id_response = '.$user->id.' and status = "0")
        ');
        return response()->json($friend);
    }

    public function updateFriend(Request $request, $id, $code)
    {
        $user = Auth::user();
        $friendreq = App\Friend::where('user_id_response', $user->id)->where('user_id_action',$id)->firstOrFail();
        $friendreq->status = $code;
        $friendreq->save();
        return response()->json(['status' => 'success','message' => 'success update friend']);
    }

    public function updateBand(Request $request, $id, $friendid, $code)
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
