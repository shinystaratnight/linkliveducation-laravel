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
                <li><a href="<?php echo e(URL::to('admin/vlog')); ?>">Add VLog</a></li>
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
                <h3 align="center" >All VLog</h3>
                <div class="block-content block-content-narrow"> 
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SNo</th>
                                <th>Title</th>
                                <th>Youtube Link</th>
                                <th>Action</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php $i=1; ?>
                        <?php $__currentLoopData = $vlog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($i); ?></td>
                            <td><?php echo e($row->title); ?></td>
                            <td><?php echo e($row->name); ?></td>
                            <td><a href="<?php echo e(URL::to('admin/edit_vlog/'.$row->id)); ?>">Edit</a></td>
                            <td><a href="<?php echo e(URL::to('admin/delete_vlog/'.$row->id)); ?>" onclick="return confirm('Are You Sure?')">Delete</a></td>
                        </tr>
                        <?php $i++ ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->            
<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.admin_app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\linkliveducation\resources\views/admin/pages/allvlog.blade.php ENDPATH**/ ?>