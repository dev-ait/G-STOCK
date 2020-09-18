<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_order extends Model
{
    public function order() {

        return $this->belongsTo('App\Order');
   
         }

         public function cv() {

            return $this->belongsTo('App\Cv');
       
             } 

}
