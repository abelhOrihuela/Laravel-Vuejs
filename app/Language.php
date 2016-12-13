<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';

    public function candidate(){
      return $this->belongsTo(Candidate::class, 'candidate_id');
    }
}
