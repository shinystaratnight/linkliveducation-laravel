<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login_with','usertype','remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getUserInfo($id) 
    { 
        return User::find($id);
    }

    public static function getUserFullname($id) 
    { 
        $userinfo=User::find($id);

        return $userinfo->first_name.' '.$userinfo->last_name;
    }
    
    public function tests(){
        return $this->belongsToMany('App\Quiz');
    }

    public function checkQuizTaken($id){
        $user = Auth::user();
        $mark = Marks::get()->where('quiz_id', $id)->where('user_id', $user->id)->first();
//        return $mark->marks;
        if($mark == null){
            return 0;
        }
        else {
            return 1;
        }
    }

    public function checkMarks($id){
        $mark = Marks::get()->where('quiz_id', $id)->where('user_id', Auth::user()->id)->first();
        return $mark->marks;
    }

    public function checkQuizBought($id){
        $tests = Auth::user()->tests;
        $quiz = Quiz::findOrFail($id);
//        $tests->firstWhere('id', $id);
        if($tests->contains($quiz)){
            return 1;
        }
        else{
            return 0;
        }
    }
}
