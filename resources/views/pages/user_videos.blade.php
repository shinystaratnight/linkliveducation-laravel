@extends('app1')
@section('content')
@include("includes.user_profile_nav")
<div class="row text-center cover-container-inner-sec">
    <h1 class="profile-name-gallery">
        {{Auth::user()->first_name}}'s Videos
    </h1>
</div>
<div class="container" style="margin-top:20px;">
    <div class="row">
        <div class="col-md-12">
            <div id="grid" class="row videos-panl">
                @if(isset($subcat))
                @foreach($subcat as $subc)
                <div class="mix col-sm-3 page1 page4 margin30">
                    <div class="item-img-wrap ">
                        <a href="{{ URL::to('course-videos/'.$subc->id.'/'.$subc->name) }}" >{{$subc->name}}</a>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="row gallery-bottom">
        <div class="col-sm-6">
            {{ $subcat->render() }}
        </div> 
        <div class="col-sm-6 text-right user-profright-phot">
            <p>Displaying {{$subcat->firstItem()}} - {{$subcat->lastItem()}} <span> of {{$subcat->total()}} Videos</span></p>
        </div>
    </div>
</div>
@endsection