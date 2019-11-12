 <!-- Header Section Start -->
    <header id="home" class="hero-area">    
     
      <nav class="navbar navbar-expand-md bg-inverse fixed-top scrolling-navbar">
        <div class="container">
          <a href="<?php echo e(URL::asset('/')); ?>" class="navbar-brand">LinkLiv Education</a>       
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <i class="lni-menu"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto w-100 justify-content-end">
                <li class="nav-item <?php
                if ($_SERVER['REQUEST_URI'] == '/') {
                    echo 'active';
                }
                ?>"><a href="<?php echo e(URL::asset('/')); ?>" class="nav-link page-scroll">Home</a></li>
                <li class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Video Courses</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php $coursevideos = App\StudyMaterialCat::get(); ?>
                        <?php if(!empty($coursevideos)): ?>
                            <?php $__currentLoopData = $coursevideos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coursevideo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                            <a href="<?php echo e(URL::to('video-courses/'.$coursevideo->id.'/'.$coursevideo->name)); ?>" class="dropdown-item"><?php echo $coursevideo->name; ?></a>
                           
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </li>
              <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Certifications
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php $categories = App\TestCat::get(); ?>
                        <?php if(!empty($categories)): ?>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a class="dropdown-item" href="<?php echo e(URL::to('subCategories/'.$category->id)); ?>"><?php echo $category->name; ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
              </li>
              <li class="nav-item <?php
                if ($_SERVER['REQUEST_URI'] == '/faq') {
                    echo 'active';
                }
                ?>"><a href="<?php echo e(URL::asset('faq')); ?>" class="nav-link page-scroll">FAQ</a></li>
              <li class="nav-item">
                <a class="nav-link page-scroll" href="<?php echo e(URL::asset('partner')); ?>">Partner</a>
              </li>     
              <li class="nav-item <?php
                if ($_SERVER['REQUEST_URI'] == '/vlog') {
                    echo 'active';
                }
                ?>"><a href="<?php echo e(URL::asset('vlog')); ?>" class="nav-link">Team</a></li>
                <li class="nav-item <?php
                if ($_SERVER['REQUEST_URI'] == '/contact') {
                    echo 'active';
                }
                ?>"><a href="<?php echo e(URL::asset('contact')); ?>" class="nav-link">Contact Us</a></li>
                <li class="nav-item">
                    <?php if(!Auth::check()): ?>
                    <a href="<?php echo e(URL::asset('signin')); ?>" class="btn btn-singin">Sign In</a>
                    <?php else: ?>
                    <a href="<?php echo e(URL::asset('profile')); ?>" class="btn btn-singin">Profile</a>
                    <?php endif; ?>
                </li>
            </ul>
          </div>
        </div>
      </nav>  
                 
    </header>
    <!-- Header Section End --> 
<?php /**PATH /home/scholer1/public_html/resources/views/includes/header.blade.php ENDPATH**/ ?>