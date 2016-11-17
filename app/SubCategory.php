<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'subcategories';

  public function candidates(){
    return $this->hasMany(Candidate::class, 'subcategory', 'id');
  }
}
