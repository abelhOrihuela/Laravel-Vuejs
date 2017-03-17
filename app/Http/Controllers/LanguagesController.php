<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Language;

class LanguagesController extends Controller
{

  public function index($id){
      $languages = Language::where("candidate_id", "=", $id)->get();

      return $languages;

  }

  public function create(Request $request){

    $language = new Language();

    if($request->name_language){
      $language->name_language=$request->name_language;
    }

    if($request->level_language){
      $language->level_language=$request->level_language;
    }

    if($request->candidate_id){
      $language->candidate_id=$request->candidate_id;
    }


    if($language->save()){
      return  $language;
    }else{
      abort(404);
    }
  }
  public function destroy($id){
    $language = Language::where("id", "=", $id);
    if($language->forceDelete()){
      return response()->json([
        'status' => 200
      ]);
    }else{
      return $id;
    }
  }
}
