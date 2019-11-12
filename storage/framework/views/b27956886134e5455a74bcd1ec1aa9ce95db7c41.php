<?php $__env->startSection('content'); ?>
<?php

function convert_created_at_time($date) {
    $datetime1 = new DateTime();
    $datetime2 = new DateTime($date);
    $interval = $datetime1->diff($datetime2);
    if ($interval->i == 0 && $interval->h == 0 && $interval->d == 0 && $interval->m == 0 && $interval->y == 0) {
        $time = $interval->format(' %s seconds');
    } else if ($interval->i > 0 && $interval->h == 0 && $interval->d == 0 && $interval->m == 0 && $interval->y == 0) {
        $time = $interval->format(' %i minutes ');
    } else if ($interval->h > 0 && $interval->d == 0 && $interval->m == 0 && $interval->y == 0) {
        $time = $interval->format(' %h hours');
    } else if ($interval->d > 0 && $interval->m == 0 && $interval->y == 0) {
        $time = $interval->format(' %a days ');
    } else if ($interval->m > 0 && $interval->y == 0) {
        $time = $interval->format(' %m months  ');
    } else if ($interval->y > 0) {
        $time = $interval->format(' %y years   ');
    }
    return $time;
}
?>
<?php echo $__env->make("includes.user_profile_nav", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="modal fade" id="edit-cover-pic-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel">Edit Cover Pic</h3>
            </div>
            <div class="modal-body">
                <div class="back-image-of-edit-to-profile">
                    <img  src="<?php echo e(URL::asset('/'.Auth::user()->cover_pic)); ?>" class="img-responsive" id="output" style="transform: rotate(<?php echo e(@$post->imgrotation); ?>deg);">
                </div>
            </div>
            <div class="modal-footer">
                <?php echo Form::open(array('url' => 'cover_pic','id'=>'cover_pic','role'=>'form','enctype' => 'multipart/form-data')); ?>

                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="file" name="cover_pic" onchange="loadFile(event)" />
                <div class="btn-group" role="group" aria-label="group button">
                    <button onClick="window.location.reload()" type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                    <button type="button" id="delImage123" class="btn btn-default btn-hover-red" data-dismiss="modal"  role="button" onClick="window.location.reload()" >Delete</button>
                    <button type="submit" id="saveImage" class="btn btn-default btn-hover-green" data-action="save" role="button">Save</button>
                </div>
                <?php echo Form::close(); ?> 
            </div>
        </div>
    </div>
</div>
<script>
var loadFile = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById('output');
        output.src = reader.result;
        output.style.width = '100%';
        output.style.height = '200px';
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/scholer1/public_html/resources/views/pages/profile.blade.php ENDPATH**/ ?>