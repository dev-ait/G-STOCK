<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{


         public function product(){

            return $this->hasMany('App\Product');
            
          }   
}
