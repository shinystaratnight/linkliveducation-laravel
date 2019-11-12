<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $__env->yieldContent('head_title', getcong('site_name')); ?></title>
        <meta name="description" content="<?php echo $__env->yieldContent('head_description', getcong('site_description')); ?>" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="<?php echo $__env->yieldContent('head_title',  getcong('site_name')); ?>" />
        <meta property="og:description" content="<?php echo $__env->yieldContent('head_description', getcong('site_description')); ?>" />
        <meta property="og:keywords" content="<?php echo $__env->yieldContent('head_keywords', getcong('site_description')); ?>" />
        <meta property="og:image" content="<?php echo $__env->yieldContent('head_image', url('/upload/logo.png')); ?>" />
        <meta property="og:url" content="<?php echo $__env->yieldContent('head_url', url('/')); ?>" />

        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
        <link rel="stylesheet" id="css-main" href="<?php echo e(URL::asset('site_assets/css/style.css')); ?>">
        <link rel="stylesheet" id="css-main" href="<?php echo e(URL::asset('site_assets/css/open-iconic-bootstrap.min.css')); ?>">
        <link rel="stylesheet" id="css-main" href="<?php echo e(URL::asset('site_assets/assets/css/bootstrap.min.css')); ?>">
        <link rel="stylesheet" id="css-main" href="<?php echo e(URL::asset('site_assets/css/animate.css')); ?>">
        <link rel="stylesheet" id="css-main" href="<?php echo e(URL::asset('site_assets/css/owl.carousel.min.css')); ?>">
        <link rel="stylesheet" id="css-main" href="<?php echo e(URL::asset('site_assets/css/owl.theme.default.min.css')); ?>">
        <link rel="stylesheet" id="css-main" href="<?php echo e(URL::asset('site_assets/css/magnific-popup.css')); ?>">
        <link rel="stylesheet" id="css-main" href="<?php echo e(URL::asset('site_assets/css/aos.css')); ?>">
        <link rel="stylesheet" id="css-main" href="<?php echo e(URL::asset('site_assets/css/ionicons.min.css')); ?>">
        <link rel="stylesheet" id="css-main" href="<?php echo e(URL::asset('site_assets/css/bootstrap-datepicker.css')); ?>">
        <link rel="stylesheet" id="css-main" href="<?php echo e(URL::asset('site_assets/css/jquery.timepicker.css')); ?>">
        <link rel="stylesheet" id="css-main" href="<?php echo e(URL::asset('site_assets/css/flaticon.css')); ?>">
        <link rel="stylesheet" id="css-main" href="<?php echo e(URL::asset('site_assets/css/icomoon.css')); ?>">
        
        <link rel="stylesheet" href="<?php echo e(URL::asset('site_assets/assets/css/LineIcons.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(URL::asset('site_assets/assets/css/nivo-lightbox.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(URL::asset('site_assets/assets/css/main.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(URL::asset('site_assets/assets/css/responsive.css')); ?>">
        <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.css">
        <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">
        <?php echo $__env->yieldContent('extra-css'); ?>
    </head>
   <body>
            <?php echo $__env->make("includes.header", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->yieldContent("content"); ?>
            <?php echo $__env->make("includes.footer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
    <script src="<?php echo e(URL::asset('site_assets/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('site_assets/js/jquery-migrate-3.0.1.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('site_assets/assets/js/popper.min.js')); ?>"></script>
    <script src="/public/site_assets/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo e(URL::asset('site_assets/assets/js/jquery.easing.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('site_assets/js/jquery.waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('site_assets/js/jquery.stellar.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('site_assets/js/owl.carousel.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('site_assets/assets/js/jquery.magnific-popup.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('site_assets/assets/js/nivo-lightbox.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('site_assets/js/aos.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('site_assets/js/jquery.animateNumber.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('site_assets/js/bootstrap-datepicker.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('site_assets/js/jquery.timepicker.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('site_assets/js/scrollax.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('site_assets/js/main.js')); ?>"></script>
    
    <script src="/public/site_assets/assets/js/jquery.nav.js"></script>    
    <script src="<?php echo e(URL::asset('site_assets/assets/js/scrolling-nav.js')); ?>"></script>  
    <script src="https://unpkg.com/swiper/js/swiper.js"></script>
    <script src="https://unpkg.com/swiper/js/swiper.min.js"></script>
    <script src="<?php echo e(URL::asset('site_assets/assets/js/main.js')); ?>"></script>
    
    
    </body>
</html><?php /**PATH /Volumes/Data/Workspace/Source/PHP/Akash_Yadav/scholer1_linkliveducation/resources/views/app.blade.php ENDPATH**/ ?>