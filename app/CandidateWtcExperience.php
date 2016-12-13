<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CandidateWtcExperience extends Model
{
  protected $table = 'candidatewtcexperience';

  public function candidate(){
    return $this->belongsTo(Candidate::class, 'id');
  }
}
