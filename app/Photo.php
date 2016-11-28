<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

  protected $table = 'photos';
  protected $fillable = ['user_id', 'photo'];


    public function candidate(){
      return $this->belongsTo(Candidate::class, 'candidate_id');
    }


}