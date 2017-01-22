<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Customer;
use Hash;
use Crypt;
use Session;


class CustomersController extends Controller
{

  function index(){
    $customers=Customer::all();

    foreach ($customers as $customer) {
      $customer->categoryCustomer;
      $customer->subcategoryCustomer;
    }

    return $customers;
  }

  public function create(Request $request){
    $customer=new Customer();


    $token= password_hash($request->password, PASSWORD_DEFAULT);



    $customer->username=$request->username;
    $customer->gender=$request->gender;
    $customer->email=$request->email;
    $customer->password=$token;
    $customer->user_id= Session::get('user_id');
    $customer->company=$request->company;
    $customer->type=$request->type;
    $customer->comments=$request->comments;
    $customer->category=$request->category;
    $customer->subcategory=$request->subcategory;


    if($customer->save()){

      $customer->categoryCustomer;
      $customer->subcategoryCustomer;

      return  $customer;
    }else{
      abort(404);
    }
    return $request;


  }
  public function store(Request $request){

    $user = Customer::where("email", "=" , $request->email)->first();

    if($user){
      $hash  = $user->password;
      $password = $request->password;
      $validate = false;
      $validate = password_verify ( $password ,  $hash );
      if($validate){
        Session::put('customer_id', $user->id);
        $token= hash('ripemd160', 'session token');
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
