<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CandidateAcademic extends Model
{

      protected $table = 'candidateacademic';
  public function candidate(){
    return $this->belongsTo(Candidate::class, 'candidate_id');
  }
}
