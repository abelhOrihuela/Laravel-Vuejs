<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Candidate;
use Hash;
use Crypt;
use Session;

class UsersController extends Controller
{

	public function index(){
		$admins=User::all();
		return $admins;
	}

  public function candidates($id){
    $candidates=Candidate::where("user_id", "=", $id)->count();
    return response()->json(['candidates' => $candidates ]);
  }
  public function create(Request $request){

    $options = [
    'cost' => 12,
    ];
    $newpass= password_hash($request->password, PASSWORD_BCRYPT, $opciones)."\n";
  }



  public function store(Request $request){

    $user = User::where("email", "=" , $request->email)->first();

    if($user){
      $hash  = $user->password;
      $password = $request->password;
      $validate = false;
      $validate = password_verify ( $password ,  $hash );
      if($validate){
				Session::put('user', $user->id);
        $token= hash('ripemd160', 'The quick brown fox jumped over the lazy dog.');
        return response()->json(['user' => $user, 'token' => $hash, 'type_user' => 1 ]);

      }else{
        return response()->json(['password_incorrect' => true ]);
      }
    }
    else{
      abort(404);
    }
  }
}
