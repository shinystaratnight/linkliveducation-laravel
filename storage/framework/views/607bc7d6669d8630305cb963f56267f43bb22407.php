<?php $__env->startSection('content'); ?>

<div class="container" style="margin-top: 5rem;">

    <?php if(count($tests)>0): ?>
    <h1 class="text-center" style="margin-bottom: 5rem;">Tests</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
            <th scope="col">Time</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <th scope="row"><?php echo e($test->id); ?></th>
            <td><?php echo e($test->subCategory->name); ?></td>
            <td>$<?php echo e($test->price); ?></td>
            <td><?php echo e($test->time); ?></td>
            <td>
                <a href="<?php echo e(route('questions', $test->id)); ?>" class="btn btn-primary">View Questions</a>
                <a href="<?php echo e(route('anotherQuestion', $test->id)); ?>" class="btn btn-success">Add Questions</a>
                <a href="<?php echo e(route('quizUpdate', $test->id)); ?>" class="btn btn-warning">Edit</a>
                <?php echo Form::open(['method'=> 'DELETE', 'action'=> ['Admin\TestController@destroyTest', $test->id], 'style'=>'display:inline-block']); ?>

                <?php echo Form::button('Delete', ['type' => 'submit', 'class'=> 'btn btn-danger', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Delete']); ?>

                <?php echo Form::close(); ?>

            </td>
            </td>
        </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
        <?php else: ?>
        <h1 class="text-center" style="margin-bottom: 5rem;">No Tests Found</h1>
        <?php endif; ?>
</div>



    <?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.admin_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/scholer1/public_html/resources/views/admin/pages/quizIndex.blade.php ENDPATH**/ ?>