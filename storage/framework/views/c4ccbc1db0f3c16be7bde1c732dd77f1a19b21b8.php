<?php $__env->startSection('content'); ?>



        <div class="container" style="margin-top: 10rem;">

            <h3 class="text-center">Upload Test Information</h3>



            <?php echo Form::open(array('url' => array('admin/test/store'),'class'=>'form-horizontal padding-15','role'=>'form','enctype' => 'multipart/form-data')); ?>






            <div class="form-row container" style="margin-top: 5rem;">
                <div class="col-sm-4">

                    <select class="form-control" name="test_cat_id" id="categories">
                        <option value="0" disabled selected>Choose Category</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-sm-4">

                    <select class="form-control" name="test_subcat_id" id="subCategories">
                        <option value="0" disabled selected>Choose Sub Category</option>
                        <?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($subCategory->id); ?>"><?php echo e($subCategory->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <?php echo Form::file('image', null, ['class'=>'form-control']); ?>

                </div>
            </div>

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
                <div class="col-sm-6">
                    <?php echo Form::text('price', null, ['class'=>'form-control', 'placeholder'=>'Price']); ?>

                </div>
                <div class="col-sm-6">
                    <?php echo Form::text('time', null, ['class'=>'form-control', 'placeholder'=>'Time']); ?>

                </div>
            </div>

            <h3 class="text-center" style="margin-top: 5rem;">Upload Questions</h3>

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
                    </div>
                </div>
            </div>


            <div class="form-row container" style="margin-top: 5rem; margin-bottom: 5rem;">
                <br>
                <div class="col-sm-3">
                <?php echo Form::submit('Create Quiz', ['class'=> 'form-control btn btn-outline-danger']); ?>

                </div>
                <div class="col-sm-3">
                    <button type="button" id="addQuestion" class="form-control btn btn-outline-danger">Add Question</button>
                </div>
                <div class="col-sm-3">
                    <button type="button" id="deleteQuestion" class="form-control btn btn-outline-danger">Delete Last Question</button>
                </div>
            </div>
            <?php echo Form::close(); ?>


        </div>
        <?php echo $__env->make('includes.form_error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>




    <?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.admin_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/scholer1/public_html/resources/views/admin/pages/create_quiz.blade.php ENDPATH**/ ?>