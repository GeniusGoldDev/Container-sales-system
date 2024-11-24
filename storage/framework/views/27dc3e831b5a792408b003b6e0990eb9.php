

<?php $__env->startSection('title','E-SHOP || Blog Page'); ?>

<?php $__env->startSection('main-content'); ?>
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="<?php echo e(route('home')); ?>">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">Blog Grid Sidebar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Blog Single -->
    <section class="blog-single shop-blog grid section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="row">
                        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                            <div class="col-lg-6 col-md-6 col-12">
                                <!-- Start Single Blog  -->
                                <div class="shop-single-blog">
                                <img src="<?php echo e($post->photo); ?>" alt="<?php echo e($post->photo); ?>">
                                    <div class="content">
                                        <p class="date"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo e($post->created_at->format('d M, Y. D')); ?>

                                            <span class="float-right">
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                 <?php echo e($post->author_info->name ?? 'Anonymous'); ?>

                                            </span>
                                        </p>
                                        <a href="<?php echo e(route('blog.detail',$post->slug)); ?>" class="title"><?php echo e($post->title); ?></a>
                                        <p><?php echo html_entity_decode($post->summary); ?></p>
                                        <a href="<?php echo e(route('blog.detail',$post->slug)); ?>" class="more-btn">Continue Reading</a>
                                    </div>
                                </div>
                                <!-- End Single Blog  -->
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-12">
                            <!-- Pagination -->
                            
                            <!--/ End Pagination -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="main-sidebar">
                        <!-- Single Widget -->
                        <div class="single-widget search">
                            <form class="form" method="GET" action="<?php echo e(route('blog.search')); ?>">
                                <input type="text" placeholder="Search Here..." name="search">
                                <button class="button" type="sumbit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <!--/ End Single Widget -->
                        <!-- Single Widget -->
                        <div class="single-widget category">
                            <h3 class="title">Blog Categories</h3>
                            <ul class="categor-list">
                                <?php if(!empty($_GET['category'])): ?>
                                    <?php
                                        $filter_cats=explode(',',$_GET['category']);
                                    ?>
                                <?php endif; ?>
                            <form action="<?php echo e(route('blog.filter')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    
                                    <?php $__currentLoopData = Helper::postCategoryList('posts'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(route('blog.category',$cat->slug)); ?>"><?php echo e($cat->title); ?> </a>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </form>

                            </ul>
                        </div>
                        <!--/ End Single Widget -->
                        <!-- Single Widget -->
                        <div class="single-widget recent-post">
                            <h3 class="title">Recent post</h3>
                            <?php $__currentLoopData = $recent_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <!-- Single Post -->
                                <div class="single-post">
                                    <div class="image">
                                        <img src="<?php echo e($post->photo); ?>" alt="<?php echo e($post->photo); ?>">
                                    </div>
                                    <div class="content">
                                        <h5><a href="#"><?php echo e($post->title); ?></a></h5>
                                        <ul class="comment">
                                            <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo e($post->created_at->format('d M, y')); ?></li>
                                            <li><i class="fa fa-user" aria-hidden="true"></i>
                                                <?php echo e($post->author_info->name ?? 'Anonymous'); ?>

                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- End Single Post -->
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <!--/ End Single Widget -->
                        <!-- Single Widget -->
                        <!--/ End Single Widget -->
                        <!-- Single Widget -->
                        <div class="single-widget side-tags">
                            <h3 class="title">Tags</h3>
                            <ul class="tag">
                                <?php if(!empty($_GET['tag'])): ?>
                                    <?php
                                        $filter_tags=explode(',',$_GET['tag']);
                                    ?>
                                <?php endif; ?>
                                <form action="<?php echo e(route('blog.filter')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php $__currentLoopData = Helper::postTagList('posts'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <li>
                                                <a href="<?php echo e(route('blog.tag',$tag->title)); ?>"><?php echo e($tag->title); ?> </a>
                                            </li>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </form>
                            </ul>
                        </div>
                        <!--/ End Single Widget -->
                        <!-- Single Widget -->
                        <div class="single-widget newsletter">
                            <h3 class="title">Newslatter</h3>
                            <div class="letter-inner">
                                <h4>Subscribe & get news <br> latest updates.</h4>
                                <form method="POST" action="<?php echo e(route('subscribe')); ?>" class="form-inner">
                                    <?php echo csrf_field(); ?>
                                    <input type="email" name="email" placeholder="Enter your email">
                                    <button type="submit" class="btn " style="width: 100%">Submit</button>
                                </form>
                            </div>
                        </div>
                        <!--/ End Single Widget -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Blog Single -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
    <style>
        .pagination{
            display:inline-flex;
        }
    </style>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\work\study\Complete-Ecommerce-in-laravel-10\resources\views/frontend/pages/blog.blade.php ENDPATH**/ ?>