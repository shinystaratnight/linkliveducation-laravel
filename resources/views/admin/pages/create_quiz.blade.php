@extends('admin.admin_app')


@section('content')


{{--    <h3 class="text-center teacher-area">Teacher Area</h3>--}}
        <div class="container" style="margin-top: 10rem;">

            <h3 class="text-center">Upload Test Information</h3>

{{--            {!! Form::open(['method'=> 'POST', 'action'=> 'TestController@store']) !!}--}}

            {!! Form::open(array('url' => array('admin/test/store'),'class'=>'form-horizontal padding-15','role'=>'form','enctype' => 'multipart/form-data')) !!}

{{--            <div class="form-group mt-5">--}}
{{--                {!! Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'Quiz Title']) !!}--}}
{{--            </div>--}}

            <div class="form-row container" style="margin-top: 5rem;">
                <div class="col-sm-4">
{{--                    {!! Form::select('category_id', ['' => 'Choose Category'] + $categories, null, ['class'=>'form-control']) !!}--}}
                    <select class="form-control" name="test_cat_id" id="categories">
                        <option value="0" disabled selected>Choose Category</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
{{--                    {!! Form::select('category_id', ['' => 'Choose Sub Category'] + $subCategories, null, ['class'=>'form-control']) !!}--}}
                    <select class="form-control" name="test_subcat_id" id="subCategories">
                        <option value="0" disabled selected>Choose Sub Category</option>
                        @foreach($subCategories as $subCategory)
                            <option value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    {!! Form::file('image', null, ['class'=>'form-control']) !!}
                </div>
            </div>

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
                <div class="col-sm-6">
                    {!! Form::text('price', null, ['class'=>'form-control', 'placeholder'=>'Price']) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::text('time', null, ['class'=>'form-control', 'placeholder'=>'Time']) !!}
                </div>
            </div>

            <h3 class="text-center" style="margin-top: 5rem;">Upload Questions</h3>

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
                    </div>
                </div>
            </div>


            <div class="form-row container" style="margin-top: 5rem; margin-bottom: 5rem;">
                <br>
                <div class="col-sm-3">
                {!! Form::submit('Create Quiz', ['class'=> 'form-control btn btn-outline-danger']) !!}
                </div>
                <div class="col-sm-3">
                    <button type="button" id="addQuestion" class="form-control btn btn-outline-danger">Add Question</button>
                </div>
                <div class="col-sm-3">
                    <button type="button" id="deleteQuestion" class="form-control btn btn-outline-danger">Delete Last Question</button>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
        @include('includes.form_error')




    @endsection