<?php $__env->startSection("content"); ?>
<section class="ftco-section ftc-no-pb">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section ftco-animate">
                <span class="subheading subheading-with-line"><small class="pr-2 bg-white"></small></span>
                <h2 class="mb-4" style="text-align: center;">VLog</h2>
            </div>
        </div>
        <div class="row">
            <?php if(!empty($vlogs)): ?>
            <?php $__currentLoopData = $vlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vlog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="staff">
                    <div class="embed-responsive embed-responsive-16by9">
                        <p><?php echo e($vlog->title); ?></p>
                        <figure>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#youtubemodal<?php echo e($vlog->id); ?>" >
                                <img class="img-responsive" src="https://img.youtube.com/vi/<?php echo e($vlog->name); ?>/0.jpg" />
                            </a>
                        </figure>
                    </div>
                </div>
            </div>
            <div id="youtubemodal<?php echo e($vlog->id); ?>" class="modal fade youtubemodal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" style="text-align: left;"><?php echo e($vlog->title); ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe width="560" height="315" src="<?php echo e('https://www.youtube.com/embed/'.$vlog->name); ?>" class="embed-responsive-item" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<script>
$(".youtubemodal").on('hidden.bs.modal', function (e) {
    $(".youtubemodal iframe").attr("src", $(".youtubemodal iframe").attr("src"));
});
</script>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\linkliveducation\resources\views/pages/vlog.blade.php ENDPATH**/ ?>