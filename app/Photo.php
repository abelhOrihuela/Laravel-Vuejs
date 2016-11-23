<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function candidate(){
      return $this->belongsTo(Candidate::class, 'candidate_id');
    }

  
}
