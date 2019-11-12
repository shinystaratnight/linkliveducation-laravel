@extends('admin.admin_app')


@section('content')


    <h3 class="text-center" style="margin-top: 5rem;">Add Questions in {{$quiz->subCategory->name}}</h3>

    {!! Form::open(array('url' => array('admin/question/store'),'class'=>'form-horizontal padding-15','role'=>'form','enctype' => 'multipart/form-data')) !!}

    <div class="parent">
        <div id="questionPlace" class="questionPlaceClass">
            <div class="form-row container" style="margin-top: 5rem;">
                <div class="col-sm-12">
                    {!! Form::textArea('question[]', null, ['class'=>'form-control', 'placeholder'=>'Question', 'rows'=>'4']) !!}
                </div>
            </div>

            {{--            <input type="hidden" value="{{$quiz->id}}" name="quiz_id">--}}

            <div class="form-row container" style="margin-top: 2rem;">
                <div class="col-sm-2">
                    {!! Form::text('option1[]', null, ['class'=>'form-control', 'placeholder'=>'Option 1']) !!}
                </div>
                <div class="col-sm-2">
                    {!! Form::text('option2[]', null, ['class'=>'form-control', 'placeholder'=>'Option 2']) !!}
                </div>
                <div class="col-sm-2">
                    {!! Form::text('option3[]', null, ['class'=>'form-control', 'placeholder'=>'Option 3']) !!}
                </div>
                <div class="col-sm-2">
                    {!! Form::text('option4[]', null, ['class'=>'form-control', 'placeholder'=>'Option 4']) !!}
                </div>
                <div class="col-sm-4">
                    {!! Form::select('isCorrect[]', ['' => 'Choose Correct Option'] + [1,2,3,4], null, ['class'=>'form-control']) !!}
                </div>
                <input type="hidden" value="{{$quiz->id}}" name="quiz_id">;
            </div>
        </div>
    </div>


    <div class="form-row container" style="margin-top: 5rem; margin-bottom: 5rem;">
        <br>
        <div class="col-sm-3">
            {!! Form::submit('Done', ['class'=> 'form-control btn btn-outline-danger']) !!}
        </div>
        <div class="col-sm-3">
            <button type="button" id="addQuestion" class="form-control btn btn-outline-danger">Add Question</button>
        </div>
        <div class="col-sm-3">
            <button type="button" id="deleteQuestion" class="form-control btn btn-outline-danger">Delete Last Question</button>
        </div>
    </div>

    {!! Form::close() !!}


    @endsection