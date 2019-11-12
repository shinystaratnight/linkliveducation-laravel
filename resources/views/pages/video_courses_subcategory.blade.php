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
                        @if(isset($coursesubcat->image))
                        <img src="{{URL::asset('upload/course/images/'.$coursesubcat->image)}}" class="img-responsive" alt="featured" />
                        @endif </div>
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name"> {{$subcat->name}} </div>
                    </div>
                    <div class="profile-userbuttons">
                        @if(Auth::check())
                            <?php
                            if(!empty($coursesubcat)){
                                $chk_order = DB::table('orders')
                                                ->where('user_id',Auth::user()->id)
                                                ->where('subcat',$coursesubcat->subcat)
                                                ->where('status','Completed')
                                                ->get();
                            }
                            ?>
                            @if(!empty($chk_order) && count($chk_order)>0)
                            <a href="{{URL::to('course-videos/'.$coursesubcat->subcat.'/'.$subcat->name)}}" class="btn btn-info">View Course</a>
                            @else
                            {!! Form::open(array('url'=>'buy-course','enctype'=>'multipart/form-data')) !!}
                            <input type="hidden" name="subcat" value="{{isset($coursesubcat->subcat) ? $coursesubcat->subcat : null}}">
                            <input type="hidden" name="name" value="{{$subcat->name}}">
                            <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-check"></span>Buy / Enroll</button>
                            {!! Form::close() !!}
                            @endif
                        @else
                        {!! Form::open(array('url'=>'buy-course','enctype'=>'multipart/form-data')) !!}
                        <input type="hidden" name="subcat" value="{{$coursesubcat->subcat}}">
                        <input type="hidden" name="name" value="{{$subcat->name}}">
                        <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-check"></span>Buy / Enroll</button>
                        {!! Form::close() !!}
                        @endif
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
                        {{isset($coursesubcat->benifit) ? $coursesubcat->benifit : null}}
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        {{isset($coursesubcat->description) ? $coursesubcat->description : null}}
                    </div>
                    <div role="tabpanel" class="tab-pane" id="messages">
                        {{isset($coursesubcat->content) ? $coursesubcat->content : null}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection