@extends('app1')



@section('content')

    @include("includes.user_profile_nav")
    <div class="row text-center cover-container-inner-sec">
        <h1 class="text-center">
            {{Auth::user()->first_name}}'s Tests
        </h1>
    </div>

        <div class="container" style="margin-bottom: 5rem; margin-top: 5rem;">
            @if(count($tests)>0)
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Description</th>
                <th scope="col">Image</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tests as $test)
            <tr>
                <td>{{$test->subCategory->name}}</td>
                <td><img height="50" width="100" alt="" src="{{asset('/site_assets/images/'.$test->image)}}"></td>
                <td>{{$test->price}}</td>
                @if(Auth::user()->checkQuizTaken($test->id)==0)
                <td><a href="#" onclick="initialize({{$test->id}})" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-sm">Take Test</a></td>
                    @else
                        @if(((Auth::user()->checkMarks($test->id)/count($test->questions))*100)<70)
                    <td><a href="" data-toggle="modal" data-target="#exampleModal1" class="btn btn-primary btn-sm">Retake Test</a></td>
                        @endif
                    @endif
            </tr>
            @endforeach
            </tbody>
        </table>
                @else
                <h3>No Tests Found</h3>
                @endif
        </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['method'=> 'POST', 'action'=> 'CertificationController@store', 'files' => true]) !!}
                        <div class="form-row container" style="margin-top: 2rem;">
                            <div class="col-sm-12">
                                {!! Form::text('Name', null, ['class'=>'form-control', 'placeholder'=>'Name']) !!}
                            </div>
                        </div>
                        <div class="form-row container" style="margin-top: 2rem;">
                            <div class="col-sm-12">
                                {!! Form::text('Email', null, ['class'=>'form-control', 'placeholder'=>'Email']) !!}
                            </div>
                        </div>
                        <div class="form-row container" style="margin-top: 2rem;">
                            <div class="col-sm-12">
                                {!! Form::text('Phone', null, ['class'=>'form-control', 'placeholder'=>'Phone']) !!}
                            </div>
                        </div>
                        <div class="form-row container" style="margin-top: 2rem;">
                            <div class="col-sm-12">
                                {!! Form::text('PAN', null, ['class'=>'form-control', 'placeholder'=>'PAN Number']) !!}
                            </div>
                        </div>
                        <div class="form-row container" style="margin-top: 2rem;">
                            <div class="col-sm-6">
                                <select class="form-control" name="country_id" id="countries">
                                    <option value="0" disabled selected>Choose Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <select class="form-control" name="states[]" id="statesHere" multiple>
                                    <option value="0" disabled selected>Choose States</option>
                                </select>
                            </div>
                        </div>
                    <input type="hidden" value="" id="hiddenId" name="hiddenId">
                        <div class="form-row container" style="margin-top: 2rem;">
                            <div class="col-sm-6">
                                {!! Form::submit('Proceed', ['class'=> 'btn btn-primary']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
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

@section('extra-js')

<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>

    <script>

        function initialize(e)
        {
            document.getElementById("hiddenId").value = e;
        }

        $('#countries').on('change', function(e){
            let country_id = e.target.value;
            $.get('/getStates/' + country_id, function(data){
                 console.log(data);
                $('#statesHere').empty();
                $('#statesHere').append('<option value="0" disabled selected>Choose States</option>');

                $.each(data, function(index, stateObj){
                    $('#statesHere').append('<option value="'+ stateObj.id +'">'+ stateObj.name +'</option>');
                })
            });
        });

$(document).ready(function() {
            var last_valid_selection = null;
            $('#statesHere').change(function(event) {
                if ($(this).val().length > 5) {
                    alert('You can only choose 5 States!');
                    $(this).val(last_valid_selection);
                } else {
                    last_valid_selection = $(this).val();
                }
            });
        });

    </script>

    @endsection