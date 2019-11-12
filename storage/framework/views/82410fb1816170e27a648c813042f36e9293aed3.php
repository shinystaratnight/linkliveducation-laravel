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
                <li><a href="<?php echo e(URL::to('admin/pages/video')); ?>">Add Video</a></li>
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
                <h3 align="center" >All Videos</h3>
                <div class="block-content block-content-narrow"> 
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SNo</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Sub-Category</th>
                                <th>Price</th>
                                <th>Position</th>
                                <th>Action</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php $__currentLoopData = $allvideo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        $i=1;
                        $catname = DB::table('study_material_cat')->where('id', $row->cat)->value('name');
                        $subcatname = DB::table('study_material_subcat')->where('id', $row->subcat)->value('name');
                        ?>
                        <tr>
                            <td><?php echo e($i); ?></td>
                            <td><?php echo e($row->description); ?></td>
                            <td><?php echo e($catname); ?></td>
                            <td><?php echo e($subcatname); ?></td>
                            <td><?php echo e($row->price); ?></td>
                            <td><?php echo e($row->position); ?></td>
                            <td><a href="<?php echo e(URL::to('admin/pages/edit_video/'.$row->id)); ?>">Edit</a></td>
                            <td><a href="<?php echo e(URL::to('admin/pages/delete_video/'.$row->id)); ?>" onclick="return confirm('Are You Sure?')">Delete</a></td>
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
<?php echo $__env->make("admin.admin_app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\linkliveducation\resources\views/admin/pages/allvideos.blade.php ENDPATH**/ ?>