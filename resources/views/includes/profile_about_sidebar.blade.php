<div class="panel ">
    <div class="user-heading round">
        <a href="{{URL::asset('profile/')}}">
            <img src="<?php if (Auth::user()->fileUpload1) { ?>{{ URL::asset('/'.Auth::user()->fileUpload1)}}<?php } else { ?> {{ URL::asset('upload/dummy.png') }} <?php } ?>" alt="" />
            <h1>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h1>
        </a>
        <p>{{isset($user->email) ? $user->email : Auth::user()->email }}</p>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            var pgurl = window.location.href;
            $("#about_menu li").removeClass("active");
            $("#about_menu a ").each(function () {

                if ($(this).attr("href") == pgurl || $(this).attr("href") == '')
                    $(this).parent('li').addClass("active");
            })
        });
    </script>
    <ul class="nav nav-pills nav-stacked" id="about_menu">
        <li><a href="{{URL::to('/user-about')}}"> <i class="fa fa-info-circle"></i> Buy / Enroll</a></li>
        <li><a href="{{URL::to('/profile-education')}}"> <i class="fa fa-graduation-cap"></i>Education</a></li>
        <li><a href="{{URL::to('/profile-skills')}}"> <i class="fa fa-cogs"></i> Skills</a></li>
        <li><a href="{{URL::to('/profile-experience')}}"> <i class="fa fa-book"></i> Experience</a></li>
        <li><a href="{{URL::to('/profile-achievement')}}"> <i class="fa fa-trophy"></i> Achievements</a></li>
    </ul>
</div>