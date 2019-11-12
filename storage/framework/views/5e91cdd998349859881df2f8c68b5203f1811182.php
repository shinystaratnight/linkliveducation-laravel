<?php $__env->startSection("content"); ?>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section ftco-animate">
                <span class="subheading subheading-with-line"><small class="pr-2 bg-white"></small></span>
                <h2 class="mb-4 about">Our Services</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6 ftco-animate">
                        <div class="blog-entry">
                            <a href="<?php echo e(URL::asset('app_for_your_website')); ?>" class="block-20" style="background-image: url('site_assets/images/App_development.jpg');">
                            </a>
                            <div class="text d-flex py-4">
                                <div class="desc">
                                    <h3 class="heading" style="text-align: center;"><a href="<?php echo e(URL::asset('app_for_your_website')); ?>">App For Your Website</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 ftco-animate">
                        <div class="blog-entry" data-aos-delay="100">
                            <a href="<?php echo e(URL::asset('vapt')); ?>" class="block-20" style="background-image: url('site_assets/images/VAPT.jpg');">
                            </a>
                            <div class="text d-flex py-4">
                                <div class="desc">
                                    <h3 class="heading" style="text-align: center;"><a href="<?php echo e(URL::asset('vapt')); ?>">VAPT To Secure Your Website/App/Software</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 ftco-animate">
                        <div class="blog-entry" data-aos-delay="200">
                            <a href="<?php echo e(URL::asset('business_development_program')); ?>" class="block-20" style="background-image: url('site_assets/images/Business_development.jpg');">
                            </a>
                            <div class="text d-flex py-4">
                                <div class="desc">
                                    <h3 class="heading" style="text-align: center;"><a href="<?php echo e(URL::asset('business_development_program')); ?>">Business Development/Corporate Training</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 ftco-animate">
                        <div class="blog-entry">
                            <a href="<?php echo e(URL::asset('startup_training_program')); ?>" class="block-20" style="background-image: url('site_assets/images/Team_training.jpg');">
                            </a>
                            <div class="text d-flex py-4">
                                <div class="desc">
                                    <h3 class="heading" style="text-align: center;"><a href="<?php echo e(URL::asset('startup_training_program')); ?>">Startup Training Program</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/scholer1/public_html/resources/views/pages/services.blade.php ENDPATH**/ ?>