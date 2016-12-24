<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\CandidateAcademicsController;
use App\CandidateAcademic;

class CandidateAcademicsController extends Controller
{
  public function create(Request $request){
    $academic=new CandidateAcademic();

    if($request->candidate_id){
      $academic->candidate_id=$request->candidate_id;
    }

    if($request->name_academic){
      $academic->name_academic=$request->name_academic;
    }
    if($request->career){
      $academic->career=$request->career;
    }
    if($request->now){
      $academic->now=$request->now;
    }

    if($request->level_academic){
      $academic->level_academic=$request->level_academic;
    }
    if($request->year_entry){
      $academic->year_entry=$request->year_entry;
    }
    if($request->year_exit){
      $academic->year_exit=$request->year_exit;
    }
    if($request->comments){
      $academic->comments=$request->comments;
    }

    if($academic->save()){
      return  $academic;
    }else{
      abort(404);
    }

  }

  public function destroy($id){

    $academic = CandidateAcademic::where("academic_id", "=", $id);
    if($academic->forceDelete()){
      return response()->json([
        'status' => 200
      ]);
    }else{
      return $id;
    }
  }

}
