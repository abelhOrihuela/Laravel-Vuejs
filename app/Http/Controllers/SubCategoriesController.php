<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\SubCategory;

class SubCategoriesController extends Controller
{

  public function index($id){

   //$subcategories=DB::table('subcategories')->where('subcategories.id_category', '=', $id)->get();

   $subcategories=SubCategory::where('id_category', '=', $id)
                ->get();
  return $subcategories;
}

}
