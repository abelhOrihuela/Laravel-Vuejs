<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Http\Requests;
use App\User;
use App\Customer;

class AuthController extends Controller
{
  public function index(Request $request){


    $user=null;
    if(User::where("email", "=" , $request->email)->first()){
      $user = User::where("email", "=" , $request->email)->first();

      Session::put('type_user', $user->type);
      Session::put('profile', 'A');

      return response()->json(['user' => $user->username, 'type' => 'A' ]);

    }else if (Customer::where("email", "=" , $request->email)->first()) {
      $user = Customer::where("email", "=" , $request->email)->first();
      Session::put('type_user', $user->type);
      Session::put('profile', 'C');

      return response()->json(['user' => $user->username, 'type' => 'C' ]);

    }else {

      abort(404);

    }

  }

  public function destroy()
  {
    Session::flush();

    return response()->json([
      'status' => 200
    ]);

  }
}
