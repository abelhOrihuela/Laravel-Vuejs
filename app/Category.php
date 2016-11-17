<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $table = 'category';

  public function candidates(){
    return $this->hasMany(Candidate::class,'id');
  }
}
