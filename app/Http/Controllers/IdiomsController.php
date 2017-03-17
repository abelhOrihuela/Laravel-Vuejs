<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Idiom;

class IdiomsController extends Controller
{

  public function index($id){


    $idioms = Idiom::where("candidate_id", "=", $id)->get();

    return $idioms;

  }
  public function create(Request $request){

    $idiom = new Idiom();

    if($request->name_idioma){
      $idiom->name_idioma=$request->name_idioma;
    }

    if($request->level_idioma){
      $idiom->level_idioma=$request->level_idioma;
    }

    if($request->candidate_id){
      $idiom->candidate_id=$request->candidate_id;
    }

    if($idiom->save()){
      return  $idiom;
    }else{
      abort(404);
    }

  }

  public function destroy($id){

    $idiom = Idiom::where("idioma_id", "=", $id);
    if($idiom->forceDelete()){
      return response()->json([
        'status' => 200
      ]);
    }else{
      return $id;
    }

  }
}
