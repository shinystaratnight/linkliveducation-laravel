@extends('admin.admin_app')

@section('content')

    <h3 class="text-center" style="margin-top: 5rem;">Edit Quiz {{$quiz->subCategory->name}}</h3>


    {!! Form::model($quiz, ['method'=> 'PATCH', 'action'=> ['Admin\TestController@quizUpdated', $quiz->id], 'files' => true]) !!}


    <div class="form-row container" style="margin-top: 5rem;">
        <div class="col-sm-12">
            {!! Form::textArea('description', null, ['class'=>'form-control', 'placeholder'=>'Description', 'id'=>'summernote']) !!}
        </div>
    </div>
    <div class="form-row container" style="margin-top: 5rem;">
        <div class="col-sm-12">
            {!! Form::textArea('tableOfContent', null, ['class'=>'form-control', 'placeholder'=>'Table of Content', 'id'=>'summernote1']) !!}
        </div>
    </div>
    <div class="form-row container" style="margin-top: 5rem;">
        <div class="col-sm-12">
            {!! Form::textArea('benefits', null, ['class'=>'form-control', 'placeholder'=>'Test Benefits', 'id'=>'summernote2']) !!}
        </div>
    </div>

    <div class="form-row container" style="margin-top: 2rem;">
        <div class="col-sm-4">
            {!! Form::text('price', null, ['class'=>'form-control', 'placeholder'=>'Price']) !!}
        </div>
        <div class="col-sm-4">
            {!! Form::text('time', null, ['class'=>'form-control', 'placeholder'=>'Time']) !!}
        </div>
        <div class="col-sm-4">
            {!! Form::file('image', null, ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="container" style="margin-top: 3em; margin-bottom: 3rem;">
    <div class="col-sm-3">
        {!! Form::submit('Edit Quiz', ['class'=> 'form-control btn btn-outline-danger']) !!}
    </div>
    </div>
    {!! Form::close() !!}


    @endsection