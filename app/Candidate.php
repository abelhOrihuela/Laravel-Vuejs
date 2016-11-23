<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
  protected $table = 'candidates';

  public function experiences(){
    return $this->hasMany(CandidateExperience::class, 'candidate_id');
  }

  public function categoryCandidate(){
    return $this->belongsTo(Category::class, 'category');
  }

  public function subcategoryCandidate(){
    return $this->belongsTo(SubCategory::class, 'subcategory');
  }

  public function photo(){
    return $this->hasOne(Photo::class, 'id'); 
  }
}
