<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\CandidateExperience;
use Utils;

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
      $experience->admission_date=Utils::formatDate($request->admission_date);
    }
    if($request->departure_date){
      $experience->departure_date=Utils::formatDate($request->departure_date);
    }

    if($experience->save()){
      return  $experience;
    }else{
      abort(404);
    }

  }

  public function update(Request $request){
    $experience=CandidateExperience::where('experience_id',  $request->experience_id);

    $input = array("experience_id" => $request->experience_id);

    if($request->name_business){
      $input["name_business"]=$request->name_business;
    }
    if($request->name_job){
      $input["name_job"]=$request->name_job;
    }
    if($request->turn_business){
      $input["turn_business"]=$request->turn_business;
    }
    if($request->now){
      $input["now"]=$request->now;
    }
    if($request->comments){
      $input["comments"]=$request->comments;
    }
    if($request->admission_date){
      $input["admission_date"]=Utils::formatDate($request->admission_date);
    }
    if($request->departure_date){
      $input["departure_date"]=Utils::formatDate($request->departure_date);
    }

    if($experience->update($input)){
      $experience=CandidateExperience::where('experience_id',  $request->experience_id)->first();
      return $experience;
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

  public function formatDate($date){

   if($date==null){
     return new Date();
   }else{
     $porciones = explode("-", $date);

     return $porciones[2]."-".$porciones[1]."-".$porciones[0];
   }

 }
}
