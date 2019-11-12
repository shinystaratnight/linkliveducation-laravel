@extends('app1')



@section('content')

    @include("includes.user_profile_nav")
    <div class="row text-center cover-container-inner-sec">
        <h1 class="text-center">
            {{Auth::user()->first_name}}'s Results
        </h1>
    </div>

    <div class="container" style="margin-bottom: 5rem; margin-top: 5rem;">
        @if(count($tests)>0)
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Description</th>
                    <th scope="col">Total Questions</th>
                    <th scope="col">Correct</th>
                    <th scope="col">Percentage</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tests as $test)
                    @if(Auth::user()->checkQuizTaken($test->id)==1)
                    <tr>
                        <td>{{$test->subCategory->name}}</td>
                        <td>{{count($test->questions)}}</td>

                        <td>{{Auth::user()->checkMarks($test->id)}}</td>
                        <td>{{((Auth::user()->checkMarks($test->id)/count($test->questions))*100)}}%</td>
                        <td>
                            @if(((Auth::user()->checkMarks($test->id)/count($test->questions))*100)<70)
                                <a href="" data-toggle="modal" data-target="#exampleModal1" class="btn btn-primary btn-sm">Retake Test</a>
                                @endif
                        </td>
{{--                        @if(Auth::user()->checkQuizTaken($test->id)==0)--}}
{{--                            <td><a href="" class="btn btn-primary btn-sm">Take Test</a></td>--}}
{{--                        @else--}}
{{--                            <td><a href="" class="btn btn-primary btn-sm">Retake Test</a></td>--}}
{{--                        @endif--}}
                    </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        @else
            <h3>No Tests Found</h3>
        @endif
    </div>
    
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        You can Retake this test after Three months.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


@endsection