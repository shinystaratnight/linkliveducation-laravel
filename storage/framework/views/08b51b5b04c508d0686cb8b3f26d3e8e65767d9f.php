<?php $__env->startSection('content'); ?>
<?php echo $__env->make("includes.user_profile_nav", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="row text-center cover-container-inner-sec">
    <h1 class="profile-name-gallery">
        <?php echo e(Auth::user()->first_name); ?>'s Videos
    </h1>
</div>
<div class="container" style="margin-top:20px;">
    <div class="row">
        <div class="col-md-12">
            <div id="grid" class="row videos-panl">
                <?php if(isset($subcat)): ?>
                <?php $__currentLoopData = $subcat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="mix col-sm-3 page1 page4 margin30">
                    <div class="item-img-wrap ">
                        <a href="<?php echo e(URL::to('course-videos/'.$subc->id.'/'.$subc->name)); ?>" ><?php echo e($subc->name); ?></a>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="row gallery-bottom">
        <div class="col-sm-6">
            <?php echo e($subcat->render()); ?>

        </div> 
        <div class="col-sm-6 text-right user-profright-phot">
            <p>Displaying <?php echo e($subcat->firstItem()); ?> - <?php echo e($subcat->lastItem()); ?> <span> of <?php echo e($subcat->total()); ?> Videos</span></p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/pages/user_videos.blade.php ENDPATH**/ ?>