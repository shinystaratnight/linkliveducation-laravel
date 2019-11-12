<?php $__env->startSection("content"); ?>

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
                        <?php if(isset($coursesubcat->image)): ?>
                        <img src="<?php echo e(URL::asset('upload/course/images/'.$coursesubcat->image)); ?>" class="img-responsive" alt="featured" />
                        <?php endif; ?> </div>
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name"> <?php echo e($subcat->name); ?> </div>
                    </div>
                    <div class="profile-userbuttons">
                        <?php if(Auth::check()): ?>
                            <?php
                            if(!empty($coursesubcat)){
                                $chk_order = DB::table('orders')
                                                ->where('user_id',Auth::user()->id)
                                                ->where('subcat',$coursesubcat->subcat)
                                                ->where('status','Completed')
                                                ->get();
                            }
                            ?>
                            <?php if(!empty($chk_order) && count($chk_order)>0): ?>
                            <a href="<?php echo e(URL::to('course-videos/'.$coursesubcat->subcat.'/'.$subcat->name)); ?>" class="btn btn-info">View Course</a>
                            <?php else: ?>
                            <?php echo Form::open(array('url'=>'buy-course','enctype'=>'multipart/form-data')); ?>

                            <input type="hidden" name="subcat" value="<?php echo e(isset($coursesubcat->subcat) ? $coursesubcat->subcat : null); ?>">
                            <input type="hidden" name="name" value="<?php echo e($subcat->name); ?>">
                            <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-check"></span>Buy / Enroll</button>
                            <?php echo Form::close(); ?>

                            <?php endif; ?>
                        <?php else: ?>
                        <?php echo Form::open(array('url'=>'buy-course','enctype'=>'multipart/form-data')); ?>

                        <input type="hidden" name="subcat" value="<?php echo e($coursesubcat->subcat); ?>">
                        <input type="hidden" name="name" value="<?php echo e($subcat->name); ?>">
                        <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-check"></span>Buy / Enroll</button>
                        <?php echo Form::close(); ?>

                        <?php endif; ?>
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
                        <?php echo e(isset($coursesubcat->benifit) ? $coursesubcat->benifit : null); ?>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        <?php echo e(isset($coursesubcat->description) ? $coursesubcat->description : null); ?>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="messages">
                        <?php echo e(isset($coursesubcat->content) ? $coursesubcat->content : null); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/scholer1/public_html/resources/views/pages/video_courses_subcategory.blade.php ENDPATH**/ ?>