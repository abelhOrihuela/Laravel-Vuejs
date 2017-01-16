<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\CandidateExperience;

class CandidateExperiencesController extends Controller
{


public function index($id){

      $experiences=CandidateExperience::where('candidate_id',  $id)->get();

      return $experiences;

}

  public function create(Request $request){

    $experience = new CandidateExperience();

    if($request->name_business){
      $experience->name_business=$request->name_business;
    }

    if($request->name_job){
      $experience->name_job=$request->name_job;
    }

    if($request->turn_business){
      $experience->turn_business=$request->turn_business;
    }

    if($request->now){
      $experience->now=$request->now;
    }

    if($request->comments){
      $experience->comments=$request->comments;
    }

    if($request->comments){
      $experience->comments=$request->comments;
    }

    if($request->candidate_id){
      $experience->candidate_id=$request->candidate_id;
    }

    if($request->admission_date){
      $experience->admission_date=$request->admission_date;
    }
    if($request->departure_date){
      $experience->departure_date=$request->departure_date;
    }

    if($experience->save()){
      return  $experience;
    }else{
      abort(404);
    }
  }

  public function update(Request $request){

    $input = $request->all();
    $experience=CandidateExperience::where('experience_id',  $request->experience_id);

    if($experience->update($input)){

      return response()->json([
        'status' => 200
      ]);

    }else{
      abort(404);
    }
  }

  public function destroy($id){
    $experience = CandidateExperience::where("experience_id", "=", $id);
    if($experience->forceDelete()){
      return response()->json([
        'status' => 200
      ]);
    }else{
      return $id;
    }
  }
}
