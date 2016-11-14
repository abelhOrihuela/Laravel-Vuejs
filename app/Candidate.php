<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
     protected $table = 'candidates';

     public function experiences(){
     	return $this->hasMany(CandidateExperience::class, 'candidate_id');
     }
}
