<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\CandidateWtcExperience;

class CandidateWtcExperienceController extends Controller
{
  public function index($id){

          $experiences=CandidateWtcExperience::where('candidate_id',  $id)->get();

          return $experiences;

  }
    public function create(Request $request){
      $experience = new CandidateWtcExperience();

      if($request->candidate_id){
        $experience->candidate_id=$request->candidate_id;
      }
      if($request->name_company){
        $experience->name_company=$request->name_company;
      }
      if($request->name_job){
        $experience->name_job=$request->name_job;
      }
      if($request->comments){
        $experience->comments=$request->comments;
      }
      if($request->date){
        $experience->date=$request->date;
      }

      if($request->consultant){
        $experience->consultant=$request->consultant;
      }


      if($experience->save()){
        return  $experience;
      }else{
        abort(404);
      }
    }

    public function update(Request $request){


      $input = $request->all();
      $experience=CandidateWtcExperience::where('wtc_id',  $request->wtc_id);

      if($experience->update($input)){

        return response()->json([
          'status' => 200
        ]);

      }else{
        abort(404);
      }

    }

    public function destroy($id){
      $experience = CandidateWtcExperience::where("wtc_id", "=", $id);
      if($experience->forceDelete()){
        return response()->json([
          'status' => 200
        ]);
      }else{
        return $id;
      }
    }

}
