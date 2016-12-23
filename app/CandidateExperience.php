<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CandidateExperience extends Model
{
    //
    protected $table = 'candidateexperience';
    protected $primarykey = 'experience_id';

    public function candidate(){
    	return $this->belongsTo(Candidate::class, 'id');
    }


}
