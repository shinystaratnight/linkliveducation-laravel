@extends("app")
@section("content")
<section class="ftco-section ftc-no-pb">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-7 heading-section ftco-animate">
                <span class="subheading subheading-with-line"><small class="pr-2 bg-white"></small></span>
                <h2 class="mb-4" style="text-align: center;">Course Details</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="portlet light profile-sidebar-portlet bordered">
                    <div class="profile-userpic">
                        @if(isset($quiz->image))
                        <img src="{{URL::asset('upload/course/images/'.$quiz->image)}}" class="img-responsive" alt="featured" />
                        @endif </div>
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name"> {{$quiz->name}} </div>
                    </div>
                    <div class="profile-userbuttons">
                       
                            @if(Auth::check())
                                @if(!Auth::user()->checkQuizBought($quiz->id)==1)
                                    <div class="action">
                                        <a class="btn btn-primary" href="{{route('buyNow', $quiz->id)}}">Buy / Enroll ${{$quiz->price}}</a>
                                    </div>
                                @endif
                            @else
                                <div class="action">
                                    <a class="btn btn-primary" href="{{route('buyNow', $quiz->id)}}">Buy / Enroll ${{$quiz->price}}</a>
                                </div>
                            @endif
                       
                        {!! Form::open(array('url'=>'buy-course','enctype'=>'multipart/form-data')) !!}
                       
                        <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-check"></span>Buy / Enroll</button>
                        {!! Form::close() !!}
                  
                    </div>
                    <div class="profile-usermenu">
                        <ul class="nav">
                            <li class="active">
                                <a href="#home" data-toggle="tab">
                                    <i class="icon-home"></i> Course Benefits </a>
                            </li>
                            <li>
                                <a href="#profile" data-toggle="tab">
                                    <i class="icon-settings"></i> Description </a>
                            </li>
                            <li>
                                <a href="#messages" data-toggle="tab">
                                    <i class="icon-info"></i> Table of Content </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-12">
                <div class="row tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        {{isset($quiz->benefits) ? $quiz->benefits : null}}
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        {{isset($quiz->description) ? $quiz->description : null}}
                    </div>
                    <div role="tabpanel" class="tab-pane" id="messages">
                        {{isset($quiz->content) ? $quiz->content : null}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection