<?php $__env->startSection("content"); ?>
<section class="ftco-section ftc-no-pb">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section ftco-animate">
                <span class="subheading subheading-with-line"><small class="pr-2 bg-white"></small></span>
                <h2 class="mb-4" style="text-align: center;">Course Sub-Categories</h2>
            </div>
        </div>
        <div class="row">
            <?php if(!empty($coursesubcat)): ?>
            <?php $__currentLoopData = $coursesubcat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coursesub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="staff">
                    <div class="embed-responsive embed-responsive-16by9">
                        <figure>
<!--                            <a href="<?php echo e(URL::to('video-courses-subcategory/'.$coursesub->id.'/'.$coursesub->name)); ?>" ><?php echo e($coursesub->name); ?></a>-->
                            <a href="<?php echo e(URL::to('view-course/'.$coursesub->id.'/'.$coursesub->name)); ?>" ><?php echo e($coursesub->name); ?></a>
                        </figure>
                    </div>
                    <div class="text px-4 pt-4">
                        <span class="position mb-2">
                        </span>
                        <a href="<?php echo e(URL::to('view-course/'.$coursesub->id.'/'.$coursesub->name)); ?>" >View Course</a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/pages/video_courses.blade.php ENDPATH**/ ?>