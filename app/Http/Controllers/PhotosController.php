<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Photo;

class PhotosController extends Controller
{
  public function index(){

  }

  public function create(Request $request){

    //$data = 'data:image/png; base64,AAAFBfj42Pj4';

    list($type, $imageData) = explode(';', $request->profile);
    list(,$extension) = explode('/',$type);
    list(,$imageData) = explode(',', $imageData);
    $fileName = "images/".uniqid().'.'.$extension;

    $source = fopen($request->profile, 'r');

    $destination = fopen($fileName, 'w');
    stream_copy_to_stream($source, $destination);
    fclose($source);
    fclose($destination);

    $photo=Photo::where('candidate_id','=',$request->candidate)->first();

    if($photo){
      $photo->name_photo=$fileName;
    }else{
      $photo=new Photo();
      $photo->name_photo=$fileName;
      $photo->candidate_id=$request->candidate;
    }
    if($photo->save()){
      return $photo;
    }
  }
}
