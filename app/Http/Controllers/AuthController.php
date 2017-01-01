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


    $user = User::where("email", "=" , $request->email)->first();

    if(User::where("email", "=" , $request->email)->first()){

      return response()->json(['user' => $user->username, 'type' => 'A' ]);

    }else if (Customer::where("email", "=" , $request->email)->first()) {

      return response()->json(['user' => $user->username, 'type' => 'C' ]);

    }else {

          abort(404);

    }

  }
}
