<div class="panel ">
    <div class="user-heading round">
        <a href="<?php echo e(URL::asset('profile/')); ?>">
            <img src="<?php if (Auth::user()->fileUpload1) { ?><?php echo e(URL::asset('/'.Auth::user()->fileUpload1)); ?><?php } else { ?> <?php echo e(URL::asset('upload/dummy.png')); ?> <?php } ?>" alt="" />
            <h1><?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?></h1>
        </a>
        <p><?php echo e(isset($user->email) ? $user->email : Auth::user()->email); ?></p>
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
        <li><a href="<?php echo e(URL::to('/user-about')); ?>"> <i class="fa fa-info-circle"></i> Basic Information</a></li>
        <li><a href="<?php echo e(URL::to('/profile-education')); ?>"> <i class="fa fa-graduation-cap"></i>Education</a></li>
        <li><a href="<?php echo e(URL::to('/profile-skills')); ?>"> <i class="fa fa-cogs"></i> Skills</a></li>
        <li><a href="<?php echo e(URL::to('/profile-experience')); ?>"> <i class="fa fa-book"></i> Experience</a></li>
        <li><a href="<?php echo e(URL::to('/profile-achievement')); ?>"> <i class="fa fa-trophy"></i> Achievements</a></li>
    </ul>
</div><?php /**PATH E:\xampp\htdocs\linkliveducation\resources\views/includes/profile_about_sidebar.blade.php ENDPATH**/ ?>