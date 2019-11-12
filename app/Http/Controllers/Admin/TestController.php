<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainAdminController;
use App\Http\Requests\QuestionRequest;
use App\Http\Requests\TestRequest;
use App\Marks;
use App\Question;
use App\Quiz;
use App\TestCat;
use App\TestSubcat;
use Illuminate\Http\Request;

class TestController extends MainAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tests = Quiz::all();
        return view('admin.pages.quizIndex', compact('tests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = TestCat::all();
        $subCategories = TestSubcat::all();
        return view('admin.pages.create_quiz', compact('categories', 'subCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestRequest $request)
    {
        //
        $quiz = new Quiz;
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . $file->getClientOriginalName();
            $file->move(public_path().'/site_assets/images/',$name);
            $quiz->image = $name;
        }
        $quiz->test_cat_id = $request['test_cat_id'];
        $quiz->test_subcat_id = $request['test_subcat_id'];
        $quiz->description = $request['description'];
        $quiz->tableOfContent = $request['tableOfContent'];
        $quiz->benefits = $request['benefits'];
        $quiz->price = $request['price'];
        $quiz->time = $request['time'];
        $quiz->save();
        $id = $quiz->id;
        for ($i=0; $i <count($request->question) ; $i++) {
            $question =new Question;
            $question->quiz_id = $id;
            $question->question = $request->question[$i];
            $question->option1 = $request->option1[$i];
            $question->option2 = $request->option2[$i];
            $question->option3 = $request->option3[$i];
            $question->option4 = $request->option4[$i];
            $question->isCorrect = $request->isCorrect[$i]+1;
            $question->save();
        }

        return redirect('/tests');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $question = Question::findOrFail($id);
        return view('admin.pages.questionUpdate', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, $id)
    {
        //
        $input = $request->all();
        $question = Question::findOrFail($id);
        $question->update($input);
        return redirect('/admin/tests');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $question = Question::findOrFail($id);
        $question->delete();
        return redirect()->back();
    }

    public function addQuestion(){
        return view('admin.pages.addQuestion');
    }
    public function getSubs($id){
//        $id = $request['id'];
        $category = TestCat::findOrFail($id);
        $subCategories = $category->subs;
        return $subCategories;
//        return response()->json($subCategories);
    }

    public function questions($id){
        $test = Quiz::findOrFail($id);
        $questions = $test->questions;
        return view('admin.pages.questions', compact('questions'));
    }

    public function destroyTest($id){
        $test = Quiz::findOrFail($id);
        unlink(public_path().'/site_assets/images/'.$test->image);
        $test->delete();
        return redirect()->back();
    }

    public function results(){
        $marks = Marks::all();


        return view('admin.pages.results', compact('marks'));
    }
    
    public function anotherQuestion($id){
        $quiz = Quiz::findOrFail($id);
        return view('admin.pages.anotherQuestion', compact('quiz'));
    }

    public function storeQuestion(Request $request){
        for ($i=0; $i <count($request->question) ; $i++) {
            $question =new Question;
            $question->quiz_id = $request->quiz_id;
            $question->question = $request->question[$i];
            $question->option1 = $request->option1[$i];
            $question->option2 = $request->option2[$i];
            $question->option3 = $request->option3[$i];
            $question->option4 = $request->option4[$i];
            $question->isCorrect = $request->isCorrect[$i]+1;
            $question->save();
        }
        return redirect()->route('questions', $request->quiz_id);
    }

    public function quizUpdate($id){
        $quiz = Quiz::findOrFail($id);
        return view('admin.pages.edit_quiz', compact('quiz'));
    }

    public function quizUpdated(Request $request, $id){
        $input = $request->all();
        $quiz = Quiz::findOrFail($id);

        if($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . $file->getClientOriginalName();
            $file->move(public_path().'/site_assets/images/',$name);
            unlink(public_path().'/site_assets/images/'.$quiz->image);
            $input['image']=$name;

        }

        $quiz->update($input);
        return redirect('admin/tests');

    }


}
