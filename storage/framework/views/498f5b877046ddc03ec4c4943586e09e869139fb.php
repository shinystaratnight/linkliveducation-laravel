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
</div><?php /**PATH /home/scholer1/public_html/resources/views/admin/pages/addQuestion.blade.php ENDPATH**/ ?>