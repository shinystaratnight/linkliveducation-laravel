


<?php $__env->startSection('content'); ?>

    <div class="container">
        <h1 class="text-center">Update Question</h1>

        <?php echo Form::model($question, ['method'=> 'PATCH', 'action'=> ['Admin\TestController@update', $question->id], 'files' => true]); ?>


        <div class="form-row container" style="margin-top: 5rem;">
            <div class="col-sm-12">
                <?php echo Form::text('question', null, ['class'=>'form-control', 'placeholder'=>'Question']); ?>

            </div>
        </div>

        

        <div class="form-row container" style="margin-top: 2rem;">
            <div class="col-sm-2">
                <?php echo Form::text('option1', null, ['class'=>'form-control', 'placeholder'=>'Option 1']); ?>

            </div>
            <div class="col-sm-2">
                <?php echo Form::text('option2', null, ['class'=>'form-control', 'placeholder'=>'Option 2']); ?>

            </div>
            <div class="col-sm-2">
                <?php echo Form::text('option3', null, ['class'=>'form-control', 'placeholder'=>'Option 3']); ?>

            </div>
            <div class="col-sm-2">
                <?php echo Form::text('option4', null, ['class'=>'form-control', 'placeholder'=>'Option 4']); ?>

            </div>
            <div class="col-sm-4">
                <?php echo Form::select('isCorrect', ['' => 'Choose Correct Option'] + [1,2,3,4], null, ['class'=>'form-control']); ?>

            </div>
        </div>
        <div class="container form-row" style="margin-top: 3rem;">
        <div class="col-sm-2">
            <?php echo Form::submit('Update Question', ['class'=> 'btn btn-primary']); ?>

        </div>
        </div>

        <?php echo Form::close(); ?>


    </div>
    <?php echo $__env->make('includes.form_error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.admin_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/scholer1/public_html/resources/views/admin/pages/questionUpdate.blade.php ENDPATH**/ ?>