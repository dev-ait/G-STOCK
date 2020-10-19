<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function marque() {

        return $this->belongsTo('App\Models\Marque');
   
    }
    public function gategorie() {

      return $this->belongsTo('App\Models\Gategorie');
       
     }
     public function modele() {

        return $this->belongsTo('App\Models\Modele','modele_id');
         
       }
     public function image() {

        return $this->belongsTo('App\Models\Image','photo_id');
           
     }
}
