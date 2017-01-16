<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Group;

class GroupsController extends Controller
{
  public function index(){
    $groups=Group::all();

    foreach ($groups as $group) {
      $group->categoryGroup;
      $group->subcategoryGroup;
    }

    return $groups;
  }

  public function show($id){

    $group=Group::where('id',  $id)->first();
    $group->candidates;

    foreach ($group->candidates as $candidate) {
      $candidate->categoryCandidate;
      $candidate->subcategoryCandidate;
      $candidate->languages;
      $candidate->idioms;
      $candidate->photo;
    }
    return $group;
  }

  public function create(Request $request){

    $group=Group::where('id',  $request->id)->first();
    $group->candidates()->attach($request->candidate_id);

    return $group;
  }
}
