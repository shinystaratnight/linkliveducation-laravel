<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    //
    
    protected $fillable = ['test_cat_id', 'test_subcat_id','image','description', 'tableOfContent', 'benefits', 'price', 'time'];

    public function subCategory(){
        return $this->belongsTo('App\TestSubcat', 'test_subcat_id');
    }

    public function marks(){
        return $this->belongsTo('App\Marks');
    }

    public function questions(){
        return $this->hasMany('App\Question');
    }
}
