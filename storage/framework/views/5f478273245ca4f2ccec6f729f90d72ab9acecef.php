<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand " href="<?php echo e(URL::asset('/')); ?>"><?php echo getcong('site_name'); ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse " id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php
                if ($_SERVER['REQUEST_URI'] == '/') {
                    echo 'active';
                }
                ?>"><a href="<?php echo e(URL::asset('/')); ?>" class="nav-link">Home</a></li>
                <li class="nav-item ">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Video Courses<span class="caret"></span></a>
                    <ul class="dropdown-menu">
            <?php $coursevideos = App\StudyMaterialCat::get(); ?>
                        <?php if(!empty($coursevideos)): ?>
                        <?php $__currentLoopData = $coursevideos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coursevideo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(URL::to('video-courses/'.$coursevideo->id.'/'.$coursevideo->name)); ?>"><?php echo $coursevideo->name; ?></a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </ul>
                </li>
                <li class="nav-item <?php
                    if ($_SERVER['REQUEST_URI'] == '/services') {
                        echo 'active';
                    }
                    ?>"><a href="<?php echo e(URL::asset('services')); ?>" class="nav-link">Certification</a></li>
                <li class="nav-item <?php
                if ($_SERVER['REQUEST_URI'] == '/faq') {
                    echo 'active';
                }
                ?>"><a href="<?php echo e(URL::asset('faq')); ?>" class="nav-link">FAQ</a></li>
                <li class="nav-item <?php
                if ($_SERVER['REQUEST_URI'] == '/vlog') {
                    echo 'active';
                }
                ?>"><a href="<?php echo e(URL::asset('vlog')); ?>" class="nav-link">VBlog</a></li>
                <li class="nav-item <?php
                if ($_SERVER['REQUEST_URI'] == '/contact') {
                    echo 'active';
                }
                ?>"><a href="<?php echo e(URL::asset('contact')); ?>" class="nav-link">Contact Us</a></li>
                <li class="nav-item">
                    <?php if(!Auth::check()): ?>
                    <a href="<?php echo e(URL::asset('signin')); ?>" class="nav-link">Sign In</a>
                    <?php else: ?>
                    <a href="<?php echo e(URL::asset('profile')); ?>" class="nav-link">Profile</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav><?php /**PATH /var/www/html/resources/views/includes/header.blade.php ENDPATH**/ ?>