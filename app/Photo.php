<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

  protected $table = 'photos';
  protected $fillable = ['user_id', 'photo'];


    public function candidates(){
      return $this->belongsTo(Candidate::class, 'id');
    }


}
