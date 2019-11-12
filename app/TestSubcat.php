<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestSubcat extends Model
{
   protected $table='test_subcat';
   
   public $timestamps = true;
   public function tests(){
       return $this->hasMany('App\Quiz');
   }
}
