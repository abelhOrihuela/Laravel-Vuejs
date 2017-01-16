<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Candidate;

class Group extends Model
{
  protected $table="groups";

  public function categoryGroup(){
    return $this->belongsTo(Category::class, 'category');
  }

  public function subcategoryGroup(){
    return $this->belongsTo(SubCategory::class, 'subcategory');
  }

  public function candidates(){
    return $this->belongsToMany(Candidate::class, 'relationgroup');
  }
}
