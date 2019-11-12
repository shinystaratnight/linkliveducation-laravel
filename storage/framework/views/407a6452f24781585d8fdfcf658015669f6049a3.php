<?php $__env->startSection('content'); ?>
<!--form-->
<section class="main-login-form">
    <div class="container">		
        <div class="main-form">
            <div class="row">
                <div class="col-sm-7 hidden-xs">
                    <h1><span class="autoText"></span> Learn. Test. Deserve. Achieve.</h1>
                    <figure>
                        <img src="<?php echo e(URL::asset('profile_assets/site_assets/images/login-page.png')); ?>" class="img-responsive" alt="form-img" />
                    </figure>
                </div>
                <div class="col-sm-5 col-xs-12">
                    <div class="create-form">
                        <h2>Create Your Account.</h2>
                        <div class="row">
                            <div class="message col-sm-12">
                                <?php if(count($errors) > 0): ?>
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <ul style="list-style: none;padding-left: 0px;">
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                <?php endif; ?>
                                <?php if(Session::has('dob_flash')): ?>
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <?php echo e(Session::get('dob_flash')); ?>

                                </div>
                                <?php endif; ?>
                                <?php if(Session::has('flash_message')): ?>
                                <div class="alert alert-success fade in">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <?php echo e(Session::get('flash_message')); ?>

                                </div>  
                                <?php endif; ?>
                            </div>
                            <?php echo Form::open(array('url' => 'register','id'=>'sign_up','role'=>'form','enctype' => 'multipart/form-data')); ?>

                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <div class="col-sm-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input type="text" class="form-control" name="first_name" placeholder="First Name" id="First" required>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name" id="Last" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input type="text" class="form-control"  name="username" minlength="8" placeholder="Username | Minimum 8 Characters" id="username" onchange="check_username();">
                                </div>
                                <span id="username_exists" class="text-danger"> </span>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input type="text" class="form-control"  name="email_phone" onchange="check_email();" placeholder="E-mail" id="email_id" required pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}">
                                </div>
                                <span id="email_exists" class="text-danger"> </span> 
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                    <input type="text" class="form-control" name="mobile" placeholder="Phone" onchange="check_phone();" id="mobile" required>
                                </div>
                                <span id="phone_exists" class="text-danger"> </span> 
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input type="password" class="form-control" name="password" placeholder="Password" minlength="6" id="pwd">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="input-group">
                                    <span class="main-radio">
                                        <input type="radio" id="test1" name="gender" value="male" checked>
                                        <label for="test1">Male</label>
                                    </span>
                                    <span class="main-radio">
                                        <input type="radio" id="test2" name="gender" value="female" >
                                        <label for="test2">Female</label>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <p>By clicking Sign Up, you agree to our  <a data-toggle="modal" data-target="#myModalterms"><b>Terms &amp; Conditions</b></a> and <a data-toggle="modal" data-target="#myModalprivacy"><b>Privacy Policies</b></a>.</p>
                                <button type="submit" class="btn btn-danger">Sign Up</button>
                            </div>
                            <?php echo Form::close(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>	
</section>
<script>
function check_username()
{
    var username = $("#username").val();
    $.ajax({
        type: "GET",
        url: '/check_username',
        data: {username: username},
        success: function (responce) {
            if (responce == 1)
            {
                $("#username_exists").empty();
                $("#username_exists").text('Username is already in use');
            } else {
                $("#username_exists").empty();
                $("#username_exists").text('Username is Available');
            }
        }
    });
}

function check_email()
{
    var email = $("#email_id").val();
    $.ajax({
        type: "GET",
        url: '/check_email',
        data: {email: email},
        success: function (responce) {
            if (responce == 1)
            {
                $("#email_exists").empty();
                $("#email_exists").text('Email is already in use');
            } else {
                $("#email_exists").empty();
                $("#email_exists").text('Email is Available');
            }
        }
    });
}
function check_phone()
{
    var mobile = $("#mobile").val();
    $.ajax({
        type: "GET",
        url: '/check_phone',
        data: {mobile: mobile},
        success: function (responce) {
            if (responce == 1)
            {
                $("#phone_exists").empty();
                $("#phone_exists").text('Phone No. is already in use');
            } else {
                $("#phone_exists").empty();
                $("#phone_exists").text('Phone No. is Available');
            }
        }
    });
}
</script>
<?php $__env->stopSection(); ?>       
<?php echo $__env->make('app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Volumes/Data/Workspace/Source/PHP/Akash_Yadav/scholer1_linkliveducation/resources/views/pages/signup.blade.php ENDPATH**/ ?>