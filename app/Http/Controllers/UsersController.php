<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Hash;
use Crypt;

class UsersController extends Controller
{

	public function index(){
		$admins=User::all();

		return $admins;
	}
    public function store(Request $request){



    	$user = User::where("email", "=" , $request->email)->first();
    	//$password =Crypt::decrypt($user->password);


   

    	if($user){

    		if(Hash::check($password, $user->password)){

    			return "User".$password;
    

    		}else{
    			return "Password incorrect ".$password;
    		}

    		

    	}else{
    		return "User no existe".$password;
    	}
    	



    	

    }
}
