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
                @if(!empty($video->videos))
                <?php $allvideos=json_decode($video->videos); ?>
                @foreach($allvideos as $allvideo)
                <video width="300" height="240" controls>
                    <source src="{{ URL::asset('upload/course/videos/'.$allvideo) }}">
                </video>
                <a href="{{ URL::to('watch-video/'.$video->subcat.'/'.$allvideo) }}" target="_blank">Open Video</a>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection