<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;

class CategoriesController extends Controller
{
    public function index(){
      $categories=Category::all();

      return $categories;

    }
}
