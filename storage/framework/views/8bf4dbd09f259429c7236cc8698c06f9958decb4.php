<!--header without login-->  
<?php if(!Auth::check()): ?>
    <header class="header-1">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-xs-12 logo-container">
                    <?php if(getcong('site_logo')): ?>
                    <a class="navbar-brand" href="<?php echo e(URL::to('/')); ?>">
                        <figure><img src="<?php echo e(URL::asset('profile_assets/upload/'.getcong('site_logo'))); ?>" alt="logo" /> </figure>
                    </a>
                    <?php else: ?>
                    <h2>site</h2>
                    <?php endif; ?>
                </div>
                <div class="col-lg-7 col-lg-offset-1 col-sm-8 col-xs-12 head-form">
                    <?php echo Form::open(array('url' => 'login','id'=>'sign_up','role'=>'form','enctype' => 'multipart/form-data')); ?>

                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <div class="col-lg-4 col-sm-5 col-xs-12 min-pad">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="username/email" id="usr">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-5 col-xs-12 min-pad">
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" name="password" id="usr">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-2 col-xs-12 min-pad">
                        <button  type="submit" class="btn btn-info">Login</button>
                        <a href="#forgorModal" class="pull-right"  data-toggle="modal" data-target="#forgotModal">Forgot Password</a>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>

    </header>
    <!-- Modal -->
    <div class="modal fade" id="forgotModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <?php echo Form::open(array('url' => 'password/email','class'=>'','id'=>'password','role'=>'form')); ?>

            <div class="modal-content">
                <div class="modal-body text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2>Forgot your password?</h2>
                    <p>To recover your account enter your email address below.</p>
                    <div class="form-group"><input id="email" name="email" type="text" placeholder="Enter mail" class="form-control"></div>
                    <button type="submit" id="submit" name="submit" class="submit-btn btn btn-primary">recover</button>
                </div>
            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
<?php else: ?>
    <header>
        <nav class="navbar navbar-default navbar-fixed-top navbar-principal header-1 down-pad">
            <div class="container">
                <div class="navbar-header">
                    <?php if(getcong('site_logo')): ?>
                    <a class="navbar-brand" href="<?php echo e(URL::to('/')); ?>">
                        <figure><img src="<?php echo e(URL::asset('profile_assets/upload/'.getcong('site_logo'))); ?>" alt="logo" /> </figure>
                    </a>
                    <?php else: ?>
                    <h2>site</h2>
                    <?php endif; ?>
                </div>
                <div id="navbar">
                    <ul class="nav navbar-nav navbar-right head-nav" id="header_menu">
                        <li class="hidden-xs">
                            <a href="<?php echo e(URL::to('/')); ?>"><i class="flaticon flaticon-internet" aria-hidden="true"></i>Home</a>
                        </li>
                        <li class="hidden-xs">
                            <a href="<?php echo e(URL::to('/profile')); ?>"><i class="flaticon flaticon-man-user" aria-hidden="true"></i> Profile</a>
                        </li>
                        <li class="hidden-xs">
                            <a href="<?php echo e(URL::to('/logout')); ?>"><i class="flaticon flaticon-man-user" aria-hidden="true"></i> Log out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
<?php endif; ?><?php /**PATH /Volumes/Data/Workspace/Source/PHP/Akash_Yadav/scholer1_linkliveducation/resources/views/includes/header1.blade.php ENDPATH**/ ?>