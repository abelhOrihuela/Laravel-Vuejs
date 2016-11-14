<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CandidateExperience extends Model
{
    //
    protected $table = 'candidateexperience';

    public function candidate(){
    	return $this->belongsTo(Candidate::class, 'id');
    }


}
