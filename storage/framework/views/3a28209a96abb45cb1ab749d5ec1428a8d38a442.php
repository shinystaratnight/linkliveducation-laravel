<?php $__env->startSection("content"); ?>
<!-- Page Header -->
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">
            </h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a href="<?php echo e(URL::to('admin/pages/course_subcategory')); ?>">Course SubCategories</a></li>
                <li><a class="link-effect" href=""></a></li>
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
                <h3 align="center" >Add SubCategory</h3>
                <div class="block-content block-content-narrow"> 
                    <?php if(Session::has('message')): ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <ul>
                            <li><?php echo e(Session::get('message')); ?></li>
                        </ul>
                    </div>
                    <?php endif; ?>
                    <?php echo Form::open(array('url' => array('admin/pages/add_course_subcategory'),'class'=>'form-horizontal padding-15','role'=>'form','enctype' => 'multipart/form-data')); ?> 
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label"></label>
                        <div class="col-sm-9">
                            <select name="cat_id">
                                <option value="0" >select category</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($row->id); ?>" ><?php echo e($row->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">SubCategory Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="subcategory_name" value="" class="form-control">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-sm-9 ">
                            <button type="submit" class="btn btn-primary">Subcategory</button>
                        </div>
                    </div>
                    <?php echo Form::close(); ?> 
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->            
<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.admin_app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\linkliveducation\resources\views/admin/pages/study_mat_subcategory.blade.php ENDPATH**/ ?>