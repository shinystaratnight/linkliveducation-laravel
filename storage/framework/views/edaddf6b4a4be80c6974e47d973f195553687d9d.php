

<?php $__env->startSection('content'); ?>

<div class="row" style="margin-top: 5rem;">
    <div class="container section-heading">
        <h2 class="heading">Sub Categories</h2>
        <?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <p class="d-inline"><a href="<?php echo e(route('tests', $subCategory->id)); ?>" class="btn btn-outline-secondary btn-xl border rounded mt-2"><?php echo e($subCategory->name); ?></a></p>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>




    <?php $__env->stopSection(); ?>
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/scholer1/public_html/resources/views/pages/categories.blade.php ENDPATH**/ ?>