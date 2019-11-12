<?php $__env->startSection("content"); ?>
<!-- Page Content -->
<div class="content">
    <h1 class="user-head">
        Orders
    </h1>
    <!-- Dynamic Table Full -->
    <div class="block">
        <div class="block-header">                            
        </div>
        <div class="block-content">
            <?php if(Session::has('flash_message')): ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo e(Session::get('flash_message')); ?>

            </div>
            <?php endif; ?>
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
            <table class="table table-bordered table-striped users-dataTable-full">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Price</th>
                        <th>Transaction ID</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <?php $user = DB::table('users')->where('id',$order->user_id)->first(); ?>
                        <td><?php echo e(isset($user->username) ? $user->username : null); ?></td>
                        <?php $subcat = DB::table('study_material_subcat')->where('id',$order->subcat)->first();
                              $cat = DB::table('study_material_cat')->where('id',$subcat->cat_id)->first(); ?>
                        <td><?php echo e(isset($cat->name) ? $cat->name : null); ?></td>
                        <td><?php echo e(isset($subcat->name) ? $subcat->name : null); ?></td>
                        <td><?php echo e(isset($order->price) ? $order->price : null); ?></td>
                        <td><?php echo e(isset($order->txnid) ? $order->txnid : null); ?></td>
                        <td><?php echo e(isset($order->status) ? $order->status : null); ?></td>
                        <td><?php echo e(isset($order->created_at) ? $order->created_at : null); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.admin_app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/pages/orders.blade.php ENDPATH**/ ?>