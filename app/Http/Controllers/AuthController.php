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
  public function imgProfile(Request $request){


    $user = User::where("email", "=" , $request->email)->first();

    if(User::where("email", "=" , $request->email)->first()){

      return response()->json(['admin' => $user, 'type' => 'A' ]);

    }else if (Customer::where("email", "=" , $request->email)->first()) {

      return response()->json(['customer' => $user, 'type' => 'C' ]);

    }else {

        return response()->json(['null' => null, 'type' => null ]);

    }

  }
}
