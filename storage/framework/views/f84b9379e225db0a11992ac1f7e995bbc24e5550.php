<?php $__env->startSection("content"); ?>
<style>
    .fill_cat
    {
        color:red;
    }
</style>
<!-- Page Header -->
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">
            </h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a href="<?php echo e(URL::to('admin/pages/allvideos')); ?>">All Videos</a></li>
            </ol>
        </div>
    </div>
</div>
<!-- END Page Header -->
<!-- Page Content -->
<div class="content content-boxed">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="block">
                <h3 align="center" >Add Video</h3>
                <div class="block-content block-content-narrow"> 
                    <?php if(session()->has('message')): ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <?php echo e(session()->get('message')); ?>

                    </div>
                    <?php elseif(session()->has('title_message')): ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <?php echo e(session()->get('title_message')); ?>

                    </div>
                    <?php endif; ?>
                    <?php echo Form::open(array('url' => array('admin/pages/addvideo'),'class'=>'form-horizontal padding-15','role'=>'form','enctype' => 'multipart/form-data')); ?> 
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <input type="hidden" name="id" value="<?php echo e(isset($video->id) ? $video->id : null); ?>">
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Select Category &AMP; SubCategory</label>
                        <div class="col-sm-9">
                            <select name="videocategory" onchange="loadCategory(this.value)" required>
                                <option value="" >Select Category</option>
                                <?php if(isset($category)): ?>
                                <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cat->id); ?>"<?php if(isset($video)){if($video->cat==$cat->id){echo 'selected';}} ?>><?php echo e($cat->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                            <select name="videosubcategory" id="subcategory" required>
                                <?php if(isset($subcategory)): ?>
                                <?php $__currentLoopData = $subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($subcat->id); ?>"<?php if(isset($video)){if($video->subcat==$subcat->id){echo 'selected';}} ?>><?php echo e($subcat->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <option value="">Select Category First</option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Position</label>
                        <div class="col-sm-9">
                            <input type="text" name="position" value="<?php echo e(isset($video->position) ? $video->position : null); ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="first" class="col-sm-3 control-label">Add Course Image :-</label>
                        <div class="col-md-9">
                            <div class="form-control">
                                <input type="file" name="featured_image" id="input-file" class="input-md" <?php if(empty($video->image)){echo 'required';} ?>>
                            </div>
                            <br>
                            <?php if(isset($video->image)): ?>
                            <img src="<?php echo e(URL::asset('upload/course/images/'.$video->image)); ?>" width="80" alt="featured">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                            <textarea type="text" name="description" class="form-control" required><?php echo e(isset($video->description) ? $video->description : null); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Table of Content</label>
                        <div class="col-sm-9">
                            <textarea type="text" name="content" class="form-control" required><?php echo e(isset($video->content) ? $video->content : null); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Course Benefit</label>
                        <div class="col-sm-9">
                            <textarea type="text" name="benifit" class="form-control" required><?php echo e(isset($video->benifit) ? $video->benifit : null); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Price</label>
                        <div class="col-sm-9">
                            <input type="text" name="price" value="<?php echo e(isset($video->price) ? $video->price : null); ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Video</label>
                        <div class="col-sm-9">
                            <div class="form-control">
                                <input type="file" accept="video/*" name="videos[]" multiple <?php if(empty($video->videos)){echo 'required';} ?>>
                            </div>
                            <br>
                            <?php if(!empty($video->videos)): ?>
                            <?php $allvideos=json_decode($video->videos); ?>
                            <?php $__currentLoopData = $allvideos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allvideo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <video width="320" height="240" controls>
                                <source src="<?php echo e(URL::asset('upload/course/videos/'.$allvideo)); ?>">
                            </video>
                            <a href="<?php echo e(URL::to('admin/pages/deletevideo/'.$allvideo.'/'.$video->id)); ?>"><i class="fa fa-close"></i></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-sm-9 ">
                            <button type="submit" class="btn btn-primary">submit</button>
                        </div>
                    </div>
                    <?php echo Form::close(); ?> 
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->    
<script>
    function loadCategory(key) {
        $.get('../pages/videow', {cat_id: key}, function (data) {
            if (data) {
                $('#subcategory').html('');
                $('#subcategory').append(data);
            }
        });
    }
</script>
<script>
function ReAssign(key,name) {
    alert(key);
//    $.post('deletevideo', {id: key, vid:name}, function (data) {
//        if (data) {
//            $('#subcategory').html('');
//            $('#subcategory').append(data);
//        }
//    });
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.admin_app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/pages/video.blade.php ENDPATH**/ ?>