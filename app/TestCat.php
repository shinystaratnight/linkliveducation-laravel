<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestCat extends Model
{
   protected $table='test_cat';
   
   public $timestamps = true;
   public function subs(){
       return $this->hasMany('App\TestSubcat', 'cat_id');
   }
   
   public function tests(){
        return $this->hasMany('App\Quiz');
    }
}
