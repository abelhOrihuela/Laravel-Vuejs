<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CandidateEconomic extends Model
{
    protected $table = 'candidateeconomic';

    public function candidate(){
    	return $this->belongsTo(Candidate::class, 'candidate_id');
    }
}
