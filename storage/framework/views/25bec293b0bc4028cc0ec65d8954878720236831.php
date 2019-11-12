


<?php $__env->startSection('content'); ?>


    <h3 class="text-center" style="margin-top: 5rem;">Add Questions in <?php echo e($quiz->subCategory->name); ?></h3>

    <?php echo Form::open(array('url' => array('admin/question/store'),'class'=>'form-horizontal padding-15','role'=>'form','enctype' => 'multipart/form-data')); ?>


    <div class="parent">
        <div id="questionPlace" class="questionPlaceClass">
            <div class="form-row container" style="margin-top: 5rem;">
                <div class="col-sm-12">
                    <?php echo Form::textArea('question[]', null, ['class'=>'form-control', 'placeholder'=>'Question', 'rows'=>'4']); ?>

                </div>
            </div>

            

            <div class="form-row container" style="margin-top: 2rem;">
                <div class="col-sm-2">
                    <?php echo Form::text('option1[]', null, ['class'=>'form-control', 'placeholder'=>'Option 1']); ?>

                </div>
                <div class="col-sm-2">
                    <?php echo Form::text('option2[]', null, ['class'=>'form-control', 'placeholder'=>'Option 2']); ?>

                </div>
                <div class="col-sm-2">
                    <?php echo Form::text('option3[]', null, ['class'=>'form-control', 'placeholder'=>'Option 3']); ?>

                </div>
                <div class="col-sm-2">
                    <?php echo Form::text('option4[]', null, ['class'=>'form-control', 'placeholder'=>'Option 4']); ?>

                </div>
                <div class="col-sm-4">
                    <?php echo Form::select('isCorrect[]', ['' => 'Choose Correct Option'] + [1,2,3,4], null, ['class'=>'form-control']); ?>

                </div>
                <input type="hidden" value="<?php echo e($quiz->id); ?>" name="quiz_id">;
            </div>
        </div>
    </div>


    <div class="form-row container" style="margin-top: 5rem; margin-bottom: 5rem;">
        <br>
        <div class="col-sm-3">
            <?php echo Form::submit('Done', ['class'=> 'form-control btn btn-outline-danger']); ?>

        </div>
        <div class="col-sm-3">
            <button type="button" id="addQuestion" class="form-control btn btn-outline-danger">Add Question</button>
        </div>
        <div class="col-sm-3">
            <button type="button" id="deleteQuestion" class="form-control btn btn-outline-danger">Delete Last Question</button>
        </div>
    </div>

    <?php echo Form::close(); ?>



    <?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.admin_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/scholer1/public_html/resources/views/admin/pages/anotherQuestion.blade.php ENDPATH**/ ?>