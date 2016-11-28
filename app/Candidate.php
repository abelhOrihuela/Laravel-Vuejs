<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Idiom;
use App\Language;
use App\CandidateEconomic;

class Candidate extends Model
{
  protected $table = 'candidates';

  public function experiences(){
    return $this->hasMany(CandidateExperience::class, 'candidate_id');
  }

  public function experienceWtc(){
    return $this->hasMany(CandidateWtcExperience::class, 'candidate_id');
  }

  public function categoryCandidate(){
    return $this->belongsTo(Category::class, 'category');
  }

  public function subcategoryCandidate(){
    return $this->belongsTo(SubCategory::class, 'subcategory');
  }

  public function economic(){
    return $this->hasOne(CandidateEconomic::class, 'candidate_id');
  }


  public function languages(){
    return $this->hasMany(Language::class, 'candidate_id');
  }

  public function idioms(){
    return $this->hasMany(Idiom::class, 'candidate_id');
  }


  public function photo(){
    return $this->hasOne(Photo::class, 'candidate_id');
  }
}
