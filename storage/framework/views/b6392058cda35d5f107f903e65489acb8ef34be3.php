<?php $__env->startSection('content'); ?>
<div class="row text-center cover-container" >
    <div class="container" style="margin-top:0px;">
        <div class="row ">
            <div class="col-md-12 no-paddin-xs cus-pad-topinc">
                <div class="col-md-12 no-paddin-xs">
                    <div class="profile-nav col-lg-3 col-md-4">
                        <?php echo $__env->make("includes.profile_about_sidebar", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
                    </div>
                    <div class="profile-info col-lg-9 col-md-8">
                        <div class="panel animated fadeInUp">
                            <div class="panel-body bio-graph-info about-us-block">
                                <h1 class="basic-info-text-top-head">Basic Information</h1>
                                <?php if(!isset($user)): ?>
                                <div class="plus-edit-icons-on pull-right">
                                    <span><a href="<?php echo e(URL::to('/edit-profile')); ?>" data-toggle="tooltip" data-placement="top" title="Edit Profile"><i class="fa fa-edit"></i></a></span>
                                </div>
                                <?php endif; ?> 
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 bio-row">
                                        <h4>First Name</h4>
                                        <p><?php echo e(isset($user->first_name) ? $user->first_name : Auth::user()->first_name); ?></p>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 bio-row">
                                        <h4>Last Name</h4>
                                        <p><?php echo e(isset($user->last_name) ? $user->last_name : Auth::user()->last_name); ?></p>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 bio-row">
                                        <h4>Mobile</h4>
                                        <p><?php echo e(isset($user->mobile) ? $user->mobile : Auth::user()->mobile); ?></p>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 bio-row">
                                        <h4>Gmail</h4>
                                        <p><?php echo e(isset($user->email) ? $user->email : Auth::user()->email); ?>    </p>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 bio-row">
                                        <h4>Gender</h4>
                                        <p>  <?php echo e(isset($user->gender) ? $user->gender : Auth::user()->gender); ?></p>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 bio-row">
                                        <h4>Nationality</h4>
                                        <p><?php echo e(isset($user->nationality) ? $user->nationality : Auth::user()->nationality); ?></p>                           
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\linkliveducation\resources\views/pages/profile_about.blade.php ENDPATH**/ ?>