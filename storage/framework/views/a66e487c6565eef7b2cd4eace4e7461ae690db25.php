<?php $__env->startSection('content'); ?>


    <div class="container" style="margin-top: 5rem;">

        <?php if(count($questions)>0): ?>
            <h1 class="text-center" style="margin-bottom: 5rem;">Questions</h1>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Question</th>
                    <th scope="col">Option 1</th>
                    <th scope="col">Option 2</th>
                    <th scope="col">Option 3</th>
                    <th scope="col">Option 4</th>
                    <th scope="col">Correct Option</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th scope="row"><?php echo e($question->question); ?></th>
                        <td><?php echo e($question->option1); ?></td>
                        <td><?php echo e($question->option2); ?></td>
                        <td><?php echo e($question->option3); ?></td>
                        <td><?php echo e($question->option4); ?></td>
                        <td><?php echo e($question->isCorrect); ?></td>
                        <td>
                            <a href="<?php echo e(route('questionUpdate', $question->id)); ?>" class="btn btn-warning">Update</a>
                            <?php echo Form::open(['method'=> 'DELETE', 'action'=> ['Admin\TestController@destroy', $question->id], 'style'=>'display:inline-block']); ?>

                            <?php echo Form::button('Delete', ['type' => 'submit', 'class'=> 'btn btn-danger', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Delete']); ?>

                            <?php echo Form::close(); ?>

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
<?php echo $__env->make('admin.admin_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/scholer1/public_html/resources/views/admin/pages/questions.blade.php ENDPATH**/ ?>