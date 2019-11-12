<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marks extends Model
{
    //
    protected $fillable = ['marks', 'user_id', 'quiz_id'];

    public function quiz(){
        return $this->belongsTo('App\Quiz');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function country(){
        return $this->belongsTo('App\Country');
    }
}
