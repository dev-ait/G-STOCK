<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function orderproduct(){

        return $this->hasMany('App\Models\Product_order');
        
      } 

      public function user() {

        return $this->belongsTo('App\Models\users');
   
         }
}
