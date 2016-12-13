<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idiom extends Model
{
    protected $table = 'idiomas';

    public function candidate(){
      return $this->belongsTo(Candidate::class, 'candidate_id');
    }
}
