@extends('admin.admin_app')

@section('content')


    <div class="container" style="margin-top: 5rem;">

        @if(count($questions)>0)
            <h1 class="text-center" style="margin-bottom: 5rem;">Questions</h1>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Question</th>
                    <th scope="col">Option 1</th>
                    <th scope="col">Option 2</th>
                    <th scope="col">Option 3</th>
                    <th scope="col">Option 4</th>
                    <th scope="col">Correct Option</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($questions as $question)
                    <tr>
                        <th scope="row">{{$question->question}}</th>
                        <td>{{$question->option1}}</td>
                        <td>{{$question->option2}}</td>
                        <td>{{$question->option3}}</td>
                        <td>{{$question->option4}}</td>
                        <td>{{$question->isCorrect}}</td>
                        <td>
                            <a href="{{route('questionUpdate', $question->id)}}" class="btn btn-warning">Update</a>
                            {!! Form::open(['method'=> 'DELETE', 'action'=> ['Admin\TestController@destroy', $question->id], 'style'=>'display:inline-block']) !!}
                            {!! Form::button('Delete', ['type' => 'submit', 'class'=> 'btn btn-danger', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Delete']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h1 class="text-center" style="margin-bottom: 5rem;">No Tests Found</h1>
        @endif
    </div>


    @endsection