<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Customer;

class CustomersController extends Controller
{

  function index(){
    $customers=Customer::all();
    return $customers;
  }

}
