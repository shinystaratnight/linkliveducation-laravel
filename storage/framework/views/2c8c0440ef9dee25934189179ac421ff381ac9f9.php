<footer class="footer-1 hidden-xs">
    <p>Copyright &copy; 2018 LinkLiv Education. All Rights Reserved</p>
</footer>
<div class="modal fade" id="suggestions_feedback" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php echo Form::open(array('url' => 'suggestion_feedback','id' => 'suggestion_feedback','role'=>'form','enctype' => 'multipart/form-data')); ?>

            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" ></i><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel">Suggestions &amp; Feedback</h3>
            </div>
            <div class="modal-body">
                <!-- content goes here -->
                <div class="form-group">
                    <label class="exampleInputtext" >Select Type</label>
                    <select name="type" required>
                        <option value="">Select</option>
                        <option value="Suggestion">Suggestion</option>
                        <option value="Feedback">Feedback</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="exampleInputtext" >Title</label>
                    <input type="text" class="form-control in-put-bl" name="title" placeholder="Title" required>
                </div>
                <div class="form-group">
                    <label class="exampleInputtext">Description</label>
                    <textarea class="form-control in-put-bl" name="description" rows="5" placeholder="Enter Your Suggestion Or Feedback" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                    <div class="btn-group btn-save-close" role="group ">
                        <button type="button" class="btn btn-default btn-default-green" data-dismiss="modal"  role="button">Close</button>
                    </div>
                    <div class="btn-group btn-save-close" role="group">
                        <button type="submit" class="btn btn-default btn-hover-green def" data-action="save" role="button" onclick="this.disabled = true;$('#suggestion_feedback').submit();">Send</button>
                    </div>
                </div>
            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
</div><?php /**PATH /var/www/html/resources/views/includes/footer1.blade.php ENDPATH**/ ?>