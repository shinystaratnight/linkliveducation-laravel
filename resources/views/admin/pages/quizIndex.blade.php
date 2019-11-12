@extends('admin.admin_app')

@section('content')

<div class="container" style="margin-top: 5rem;">

    @if(count($tests)>0)
    <h1 class="text-center" style="margin-bottom: 5rem;">Tests</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
            <th scope="col">Time</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tests as $test)
        <tr>
            <th scope="row">{{$test->id}}</th>
            <td>{{$test->subCategory->name}}</td>
            <td>${{$test->price}}</td>
            <td>{{$test->time}}</td>
            <td>
                <a href="{{route('questions', $test->id)}}" class="btn btn-primary">View Questions</a>
                <a href="{{route('anotherQuestion', $test->id)}}" class="btn btn-success">Add Questions</a>
                <a href="{{route('quizUpdate', $test->id)}}" class="btn btn-warning">Edit</a>
                {!! Form::open(['method'=> 'DELETE', 'action'=> ['Admin\TestController@destroyTest', $test->id], 'style'=>'display:inline-block']) !!}
                {!! Form::button('Delete', ['type' => 'submit', 'class'=> 'btn btn-danger', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Delete']) !!}
                {!! Form::close() !!}
            </td>
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