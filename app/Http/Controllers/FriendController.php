<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use App;

use Auth;

class FriendController extends Controller
{
    public function show($id)
    {
      $user = App\User::where('id',$id)->firstOrFail();
      return response()->json($user);
    }

    public function showlist($id)
    {
      $list = App\Friend::where('user_id_action',$id)->orWhere('user_id_response',$id)->firstOrFail();
      return response()->json($list);
    }

    public function addfriend(Request $request, $id)
    {
      $user = Auth::user();
      $request = new App\Friend;
      $request->user_id_action = $user->id;
      $request->user_id_response = $id;
      $request->description = $request->description;
      $request->save();

      return response()->json(['status' => 'success','message' => 'success add as friend']);

    }
}
