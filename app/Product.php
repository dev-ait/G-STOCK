<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
 

    public function marque() {

        return $this->belongsTo('App\Marque');
   
         }
         public function gategorie() {

            return $this->belongsTo('App\Gategorie');
       
             }
}
