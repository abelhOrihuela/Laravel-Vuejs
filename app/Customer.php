<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

      protected $table = 'customers';
      protected $hidden = [
          'password', 'remember_token',
      ];

      public function categoryCustomer(){
        return $this->belongsTo(Category::class, 'category');
      }

      public function subcategoryCustomer(){
        return $this->belongsTo(SubCategory::class, 'subcategory');
      }

}
