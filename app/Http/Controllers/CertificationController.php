<?php

namespace App\Http\Controllers;

use App\Country;
use App\Marks;
use App\Quiz;
use App\State;
use App\TestCat;
use App\TestSubcat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use vendor\project\StatusTest;

class CertificationController extends Controller
{
    //
    public function categories($id){

        $category = TestCat::findOrFail($id);
//        $subCategories = $category->subs;
        $tests = $category->tests;
        return view('pages.tests', compact('tests'));
//        return view('pages.categories', compact('subCategories'));
    }

    public function tests($id){
        $subCategory = TestSubcat::findOrFail($id);
        $tests = $subCategory->tests;
        return view('pages.tests', compact('tests'));
    }

    public function details($id){
        $quiz = Quiz::findOrFail($id);
        return view('pages.testProfile', compact('quiz'));
    }

    public function user_tests(){
        if (!Auth::check()) {
            return redirect('/');
        }

        $countries = Country::all();
        $states = State::all();
        $tests = Auth::user()->tests;
        return view('pages.user_tests', compact('tests', 'countries', 'states'));
    }

    public function user_results(){
        if (!Auth::check()) {
            return redirect('/');
        }
        $tests = Auth::user()->tests;
        return view('pages.user_results', compact('tests'));
    }

    public function giveTest($id){

        return view('pages.test', compact('id'));
    }

    public function buyNow($id){
        if(Auth::check()){
            $quiz = Quiz::findOrFail($id);
            $user = Auth::user();
            $user->tests()->attach($quiz);
            return redirect()->back();
        }
        else {
            return redirect('/signin');
        }

    }

    public function store(Request $request){
        $input = $request->all();
//        return $input;

        $marks = new Marks;
        $marks->name = $request['Name'];
        $marks->email = $request['Email'];
        $marks->phone = $request['Phone'];
        $marks->pan = $request['PAN'];
        $marks->quiz_id = $request['hiddenId'];
        $marks->user_id = Auth::user()->id;
        $marks->country_id = $request['country_id'];
        $marks->states = "";
        for($x=0; $x<count($input['states']) ; $x++){

            $state = State::findOrFail($input['states'][$x]);

            if($x+1<count($input['states'])){
                $marks->states = $marks->states . $state->name . ", ";
            }
            else {
                $marks->states = $marks->states . $state->name;
            }

        }
        $id = $marks->quiz_id;
        $marks->save();
        return redirect()->route('giveTest', $id);
    }

    public function getStates($id){
//        $id = $request['id'];
        $Country = Country::findOrFail($id);
        $states = $Country->states;
        return $states;
//        return response()->json($subCategories);
    }
}
