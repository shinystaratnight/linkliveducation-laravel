<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuizResource;
use App\Marks;
use App\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizApiController extends Controller
{
    //
    public function show($id)
    {
        return new QuizResource(Quiz::findOrFail($id));
    }

    public function store(Request $request){

        //return 1;

        $marks = Marks::where('quiz_id', $request['quiz_id'])->where('user_id', Auth::user()->id)->get()->first();
        //$marks->marks = $request['marks']
        $input = $request->all();
        $marks->update($input);
        return response()->json([
            'status' => true,
            ], 200);
//        $input = $request->all();
//        $input['user_id'] = Auth::user()->id;
//        Marks::create($input);
//        return redirect()->route('profile');
    }
}
