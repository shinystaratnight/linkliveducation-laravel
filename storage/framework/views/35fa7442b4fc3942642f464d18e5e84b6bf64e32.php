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
                <?php if(!empty($video->videos)): ?>
                <?php $allvideos=json_decode($video->videos); ?>
                <?php $__currentLoopData = $allvideos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allvideo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <video width="300" height="240" controls>
                    <source src="<?php echo e(URL::asset('upload/course/videos/'.$allvideo)); ?>">
                </video>
                <a href="<?php echo e(URL::to('watch-video/'.$video->subcat.'/'.$allvideo)); ?>" target="_blank">Open Video</a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\linkliveducation\resources\views/pages/course_videos.blade.php ENDPATH**/ ?>