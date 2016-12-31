<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\CandidateEconomic;
use Session;

class CandidateEconomicController extends Controller
{
    public function index($id){

      $economic=CandidateEconomic::where('candidate_id',  $id)->get();

      return $economic;

    }

    public function create(Request $request){

        $economic=new CandidateEconomic();

        $economic->candidate_id=$request->candidate_id;
        $economic->user_id=Session::get('user_id');

      if($request->current_salary){
        $economic->current_salary=$request->current_salary;
      }

      if($request->economic_package){
        $economic->economic_package=$request->economic_package;
      }

      if($request->salary_expectation){
        $economic->salary_expectation=$request->salary_expectation;
      }

      if($request->relocation){
        $economic->relocation=$request->relocation;
      }
      if($request->comments){
        $economic->comments=$request->comments;
      }

      if($economic->save()){
        return  $economic;
      }else{
        abort(404);
      }

    }

    public function update(Request $request){

      $input = $request->all();
      $economic=CandidateEconomic::where('id',  $request->id);

      if($economic->update($input)){

        return response()->json([
          'status' => 200
        ]);

      }else{
        abort(404);
      }
    }
}
