
<?php $__env->startSection("content"); ?>

    <div class="container" style="margin-bottom: 5rem; margin-top: 5rem;">
        <h1 class="text-center">Results</h1>
        <?php if(count($marks)>0): ?>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Marks</th>
                    <th scope="col">Quiz</th>
                    <th scope="col">User</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">PAN</th>
                    <th scope="col">Country</th>
                    <th scope="col">States</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $marks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($mark->marks); ?></td>
                        <td><?php echo e($mark->quiz->subCategory->name); ?></td>
                        <td><?php echo e($mark->user->first_name); ?> <?php echo e($mark->user->last_name); ?></td>
                        <td><?php echo e($mark->email); ?></td>
                        <td><?php echo e($mark->phone); ?></td>
                        <td><?php echo e($mark->pan); ?></td>
                        <td><?php echo e($mark->country->name); ?></td>
                        <td><?php echo e($mark->states); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php else: ?>
            <h3>No Results Found</h3>
        <?php endif; ?>
    </div>

    <?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.admin_app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/scholer1/public_html/resources/views/admin/pages/results.blade.php ENDPATH**/ ?>