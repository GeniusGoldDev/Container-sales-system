<!-- Meta Tag -->
<?php echo $__env->yieldContent('meta'); ?>
<!-- Title Tag  -->
<title><?php echo $__env->yieldContent('title'); ?></title>
<!-- Favicon -->
<link rel="icon" type="image/png" href="images/favicon.png">
<!-- Web Font -->
<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">


<!-- StyleSheet -->
<link rel="manifest" href="/manifest.json">
<!-- Bootstrap -->
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/bootstrap.css')); ?>">
<!-- Magnific Popup -->
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/magnific-popup.min.css')); ?>">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/font-awesome.css')); ?>">
<!-- Fancybox -->
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/jquery.fancybox.min.css')); ?>">
<!-- Themify Icons -->
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/themify-icons.css')); ?>">
<!-- Nice Select CSS -->
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/niceselect.css')); ?>">
<!-- Animate CSS -->
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/animate.css')); ?>">
<!-- Flex Slider CSS -->
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/flex-slider.min.css')); ?>">
<!-- Owl Carousel -->
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/owl-carousel.css')); ?>">
<!-- Slicknav -->
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/slicknav.min.css')); ?>">
<!-- Jquery Ui -->
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/jquery-ui.css')); ?>">

<!-- Eshop StyleSheet -->
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/reset.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/style.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/responsive.css')); ?>">
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons' async='async'></script>
<style>
    /* Multilevel dropdown */
    .dropdown-submenu {
    position: relative;
    }

    .header_topbar {
        background-color: #3131cf !important;
    }
    .top-left ul li {
        color: white !important;
    }
    .header.shop .list-main li a {
        color: white !important;
    }
    .dropdown-submenu>a:after {
    content: "\f0da";
    float: right;
    border: none;
    font-family: 'FontAwesome';
    }

    .dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: 0px;
    margin-left: 0px;
    }

    /*
</style>
<?php echo $__env->yieldPushContent('styles'); ?>
<?php /**PATH E:\work\study\Complete-Ecommerce-in-laravel-10\resources\views/frontend/layouts/head.blade.php ENDPATH**/ ?>