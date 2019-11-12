@extends('admin.admin_app')


@section('content')

    <div class="container">
        <h1 class="text-center">Update Question</h1>

        {!! Form::model($question, ['method'=> 'PATCH', 'action'=> ['Admin\TestController@update', $question->id], 'files' => true]) !!}

        <div class="form-row container" style="margin-top: 5rem;">
            <div class="col-sm-12">
                {!! Form::text('question', null, ['class'=>'form-control', 'placeholder'=>'Question']) !!}
            </div>
        </div>

        {{--            <input type="hidden" value="{{$quiz->id}}" name="quiz_id">--}}

        <div class="form-row container" style="margin-top: 2rem;">
            <div class="col-sm-2">
                {!! Form::text('option1', null, ['class'=>'form-control', 'placeholder'=>'Option 1']) !!}
            </div>
            <div class="col-sm-2">
                {!! Form::text('option2', null, ['class'=>'form-control', 'placeholder'=>'Option 2']) !!}
            </div>
            <div class="col-sm-2">
                {!! Form::text('option3', null, ['class'=>'form-control', 'placeholder'=>'Option 3']) !!}
            </div>
            <div class="col-sm-2">
                {!! Form::text('option4', null, ['class'=>'form-control', 'placeholder'=>'Option 4']) !!}
            </div>
            <div class="col-sm-4">
                {!! Form::select('isCorrect', ['' => 'Choose Correct Option'] + [1,2,3,4], null, ['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="container form-row" style="margin-top: 3rem;">
        <div class="col-sm-2">
            {!! Form::submit('Update Question', ['class'=> 'btn btn-primary']) !!}
        </div>
        </div>

        {!! Form::close() !!}

    </div>
    @include('includes.form_error')


    @endsection