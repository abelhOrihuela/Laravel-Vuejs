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

        /*

        $opciones = [
        'cost' => 12,
        ];
        $newpass= password_hash($request->password, PASSWORD_BCRYPT, $opciones)."\n";

        return $newpass;
        */



        $user = User::where("email", "=" , $request->email)->first();
        $hash  = $user->password;
        $password = $request->password;

        $validate = false;

        $validate = password_verify ( $password ,  $hash );

        if($validate){

            return "yes".$validate;

        }else{

          return "no".$validate;

      }
      


    /*
   

    	if($user){

    		if(Hash($password, $user->password)){

    			return "User".$password;
    

    		}else{
    			return "Password incorrect ".$password;
    		}

    		

    	}else{
    		return "User no existe".$password;
    	}

        */
    	



    	

    }
}
