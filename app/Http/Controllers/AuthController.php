<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Http\Requests;
use App\User;

class AuthController extends Controller
{
    public function imgProfile(Request $request){

    	$user= User::all();
    	//('email', '=', $email);

    	///$subcategories=User::where('email', '=', $email)
		 					//		->get();

		 
		return $user;

    }
}
