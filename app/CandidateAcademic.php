<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CandidateAcademic extends Model
{

  protected $table = 'candidateacademic';
  protected $primarykey = 'academic_id';

  protected $fillable = ['academic_id'];


  public function candidate(){
    return $this->belongsTo(Candidate::class, 'candidate_id');
  }
}
