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

    $opciones = [
    'cost' => 12,
    ];
    $newpass= password_hash($request->password, PASSWORD_BCRYPT, $opciones)."\n";


		$customer->username=$request->username;
		$customer->gender=$request->gender;
		$customer->email=$request->email;
		$customer->password=$newpass;
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

}
