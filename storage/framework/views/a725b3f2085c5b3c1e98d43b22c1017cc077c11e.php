<?php $__env->startSection("content"); ?>

    <!-- Services Section Start -->
    <section id="services" class="section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="features-text section-header text-center">  
              <div>   
                <h2 class="section-title">Course Sub-Categories</h2>
              </div> 
            </div>
          </div>

        </div>
        <div class="row">
          <!-- Start Col -->
            <?php if(!empty($tests)): ?>
                    <?php $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <div class="col-lg-4 col-md-6 col-xs-12">
                <div class="services-item text-center">
                  <div class="icon">
                     <i class="lni-cog"></i> 
                  </div>
                  <h4><a href="<?php echo e(route('details', $test->id)); ?>" ><?php echo e($test->subCategory->name); ?></a></h4>
                  <p>Share processes and data secure lona need to know basis Our team assured your web site is always safe.</p>
                  <a href="<?php echo e(route('details', $test->id)); ?>" >View Course</a>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

        </div>
      </div>
    </section>
    <!-- Services Section End -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make("app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/scholer1/public_html/resources/views/pages/tests.blade.php ENDPATH**/ ?>