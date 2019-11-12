

<?php $__env->startSection('content'); ?>

    <h3 class="text-center" style="margin-top: 5rem;">Edit Quiz <?php echo e($quiz->subCategory->name); ?></h3>


    <?php echo Form::model($quiz, ['method'=> 'PATCH', 'action'=> ['Admin\TestController@quizUpdated', $quiz->id], 'files' => true]); ?>



    <div class="form-row container" style="margin-top: 5rem;">
        <div class="col-sm-12">
            <?php echo Form::textArea('description', null, ['class'=>'form-control', 'placeholder'=>'Description', 'id'=>'summernote']); ?>

        </div>
    </div>
    <div class="form-row container" style="margin-top: 5rem;">
        <div class="col-sm-12">
            <?php echo Form::textArea('tableOfContent', null, ['class'=>'form-control', 'placeholder'=>'Table of Content', 'id'=>'summernote1']); ?>

        </div>
    </div>
    <div class="form-row container" style="margin-top: 5rem;">
        <div class="col-sm-12">
            <?php echo Form::textArea('benefits', null, ['class'=>'form-control', 'placeholder'=>'Test Benefits', 'id'=>'summernote2']); ?>

        </div>
    </div>

    <div class="form-row container" style="margin-top: 2rem;">
        <div class="col-sm-4">
            <?php echo Form::text('price', null, ['class'=>'form-control', 'placeholder'=>'Price']); ?>

        </div>
        <div class="col-sm-4">
            <?php echo Form::text('time', null, ['class'=>'form-control', 'placeholder'=>'Time']); ?>

        </div>
        <div class="col-sm-4">
            <?php echo Form::file('image', null, ['class'=>'form-control']); ?>

        </div>
    </div>
    <div class="container" style="margin-top: 3em; margin-bottom: 3rem;">
    <div class="col-sm-3">
        <?php echo Form::submit('Edit Quiz', ['class'=> 'form-control btn btn-outline-danger']); ?>

    </div>
    </div>
    <?php echo Form::close(); ?>



    <?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.admin_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/scholer1/public_html/resources/views/admin/pages/edit_quiz.blade.php ENDPATH**/ ?>