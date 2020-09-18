<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orderproduct(){

        return $this->hasMany('App\Product_order');
        
      } 
    
}
