<?php $__env->startSection('title','E-SHOP || HOME PAGE'); ?>
<?php $__env->startSection('main-content'); ?>
<!-- Slider Area -->
<?php if(count($banners)>0): ?>
    <section id="Gslider" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li data-target="#Gslider" data-slide-to="<?php echo e($key); ?>" class="<?php echo e((($key==0)? 'active' : '')); ?>"></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </ol>
        <div class="carousel-inner" role="listbox">
                <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="carousel-item <?php echo e((($key==0)? 'active' : '')); ?>">
                    <img class="first-slide" src="<?php echo e($banner->photo); ?>" alt="First slide">
                    <div class="carousel-caption d-none d-md-block text-left">
                        <h1 class="wow fadeInDown"><?php echo e($banner->title); ?></h1>
                        <p><?php echo html_entity_decode($banner->description); ?></p>
                        <a class="btn btn-lg ws-btn wow fadeInUpBig" href="<?php echo e(route('product-grids')); ?>" role="button">Shop Now<i class="far fa-arrow-alt-circle-right"></i></i></a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <a class="carousel-control-prev" href="#Gslider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#Gslider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
    </section>
<?php endif; ?>

<!--/ End Slider Area -->

<!-- Start Small Banner  -->
<section class="small-banner section">
    <div class="container-fluid">
        <div class="row">
            <?php
            $category_lists=DB::table('categories')->where('status','active')->limit(3)->get();
            ?>
            <?php if($category_lists): ?>
                <?php $__currentLoopData = $category_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($cat->is_parent==1): ?>
                        <!-- Single Banner  -->
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="single-banner">
                                <?php if($cat->photo): ?>
                                    <img src="<?php echo e($cat->photo); ?>" alt="<?php echo e($cat->photo); ?>">
                                <?php else: ?>
                                    <img src="https://via.placeholder.com/600x370" alt="#">
                                <?php endif; ?>
                                <div class="content">
                                    <h3><?php echo e($cat->title); ?></h3>
                                        <a href="<?php echo e(route('product-cat',$cat->slug)); ?>">Discover Now</a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- /End Single Banner  -->
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- End Small Banner -->

<!-- Start Product Area -->
<div class="product-area section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Trending Item</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-info">
                        <div class="nav-main">
                            <!-- Tab Nav -->
                            <ul class="nav nav-tabs filter-tope-group" id="myTab" role="tablist">
                                <?php
                                    $categories=DB::table('categories')->where('status','active')->where('is_parent',1)->get();
                                    // dd($categories);
                                ?>
                                <?php if($categories): ?>
                                <button class="btn" style="background:black"data-filter="*">
                                    All Products
                                </button>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <button class="btn" style="background:none;color:black;"data-filter=".<?php echo e($cat->id); ?>">
                                        <?php echo e($cat->title); ?>

                                    </button>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </ul>
                            <!--/ End Tab Nav -->
                        </div>
                        <div class="tab-content isotope-grid" id="myTabContent">
                             <!-- Start Single Tab -->
                            <?php if($product_lists): ?>
                                <?php $__currentLoopData = $product_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item <?php echo e($product->cat_id); ?>">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="<?php echo e(route('product-detail',$product->slug)); ?>">
                                                <?php
                                                    $photo=explode(',',$product->photo);
                                                // dd($photo);
                                                ?>
                                                <img class="default-img" src="<?php echo e($photo[0]); ?>" alt="<?php echo e($photo[0]); ?>">
                                                <img class="hover-img" src="<?php echo e($photo[0]); ?>" alt="<?php echo e($photo[0]); ?>">
                                                <?php if($product->stock<=0): ?>
                                                    <span class="out-of-stock">Sale out</span>
                                                <?php elseif($product->condition=='new'): ?>
                                                    <span class="new">New</span
                                                <?php elseif($product->condition=='hot'): ?>
                                                    <span class="hot">Hot</span>
                                                <?php else: ?>
                                                    <span class="price-dec"><?php echo e($product->discount); ?>% Off</span>
                                                <?php endif; ?>


                                            </a>

                                        </div>
                                        <div class="product-content">
                                            <h3><a href="<?php echo e(route('product-detail',$product->slug)); ?>"><?php echo e($product->title); ?></a></h3>
                                            <div class="product-price">
                                                <?php
                                                    $after_discount=($product->price-($product->price*$product->discount)/100);
                                                ?>
                                                <span>$<?php echo e(number_format($after_discount,2)); ?></span>
                                                <del style="padding-left:4%;">$<?php echo e(number_format($product->price,2)); ?></del>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                             <!--/ End Single Tab -->
                            <?php endif; ?>

                        <!--/ End Single Tab -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- End Product Area -->


<!-- Modal -->
<?php if($product_lists): ?>
    <?php $__currentLoopData = $product_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="modal fade" id="<?php echo e($product->id); ?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row no-gutters">
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <!-- Product Slider -->
                                        <div class="product-gallery">
                                            <div class="quickview-slider-active">
                                                <?php
                                                    $photo=explode(',',$product->photo);
                                                // dd($photo);
                                                ?>
                                                <?php $__currentLoopData = $photo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="single-slider">
                                                        <img src="<?php echo e($data); ?>" alt="<?php echo e($data); ?>">
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    <!-- End Product slider -->
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <div class="quickview-content">
                                        <h2><?php echo e($product->title); ?></h2>
                                        <div class="quickview-ratting-review">
                                            <div class="quickview-ratting-wrap">
                                                <div class="quickview-ratting">
                                                    
                                                    <?php
                                                        $rate=DB::table('product_reviews')->where('product_id',$product->id)->avg('rate');
                                                        $rate_count=DB::table('product_reviews')->where('product_id',$product->id)->count();
                                                    ?>
                                                    <?php for($i=1; $i<=5; $i++): ?>
                                                        <?php if($rate>=$i): ?>
                                                            <i class="yellow fa fa-star"></i>
                                                        <?php else: ?>
                                                        <i class="fa fa-star"></i>
                                                        <?php endif; ?>
                                                    <?php endfor; ?>
                                                </div>
                                                <a href="#"> (<?php echo e($rate_count); ?> customer review)</a>
                                            </div>
                                            <div class="quickview-stock">
                                                <?php if($product->stock >0): ?>
                                                <span><i class="fa fa-check-circle-o"></i> <?php echo e($product->stock); ?> in stock</span>
                                                <?php else: ?>
                                                <span><i class="fa fa-times-circle-o text-danger"></i> <?php echo e($product->stock); ?> out stock</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php
                                            $after_discount=($product->price-($product->price*$product->discount)/100);
                                        ?>
                                        <h3><small><del class="text-muted">$<?php echo e(number_format($product->price,2)); ?></del></small>    $<?php echo e(number_format($after_discount,2)); ?>  </h3>
                                        <div class="quickview-peragraph">
                                            <p><?php echo html_entity_decode($product->summary); ?></p>
                                        </div>
                                        <?php if($product->size): ?>
                                            <div class="size">
                                                <div class="row">
                                                    <div class="col-lg-6 col-12">
                                                        <h5 class="title">Size</h5>
                                                        <select>
                                                            <?php
                                                            $sizes=explode(',',$product->size);
                                                            // dd($sizes);
                                                            ?>
                                                            <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option><?php echo e($size); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <form action="<?php echo e(route('single-add-to-cart')); ?>" method="POST" class="mt-4">
                                            <?php echo csrf_field(); ?>
                                            <div class="quantity">
                                                <!-- Input Order -->
                                                <div class="input-group">
                                                    <div class="button minus">
                                                        <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                                            <i class="ti-minus"></i>
                                                        </button>
                                                    </div>
													<input type="hidden" name="slug" value="<?php echo e($product->slug); ?>">
                                                    <input type="text" name="quant[1]" class="input-number"  data-min="1" data-max="1000" value="1">
                                                    <div class="button plus">
                                                        <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
                                                            <i class="ti-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <!--/ End Input Order -->
                                            </div>
                                        </form>
                                        <div class="default-social">
                                        <!-- ShareThis BEGIN --><div class="sharethis-inline-share-buttons"></div><!-- ShareThis END -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<!-- Modal end -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons' async='async'></script>
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons' async='async'></script>
    <style>
        .single-product .product-img a img {
            height: 200px !important;
        }
        /* Banner Sliding */
        #Gslider .carousel-inner {
        background: #000000;
        color:black;
        }

        #Gslider .carousel-inner{
        height: 550px;
        }
        #Gslider .carousel-inner img{
            width: 100% !important;
            opacity: .8;
        }

        #Gslider .carousel-inner .carousel-caption {
        bottom: 60%;
        }

        #Gslider .carousel-inner .carousel-caption h1 {
        font-size: 50px;
        font-weight: bold;
        line-height: 100%;
        color: #F7941D;
        }

        #Gslider .carousel-inner .carousel-caption p {
        font-size: 18px;
        color: black;
        margin: 28px 0 28px 0;
        }

        #Gslider .carousel-indicators {
        bottom: 70px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>

        /*==================================================================
        [ Isotope ]*/
        var $topeContainer = $('.isotope-grid');
        var $filter = $('.filter-tope-group');

        // filter items on button click
        $filter.each(function () {
            $filter.on('click', 'button', function () {
                var filterValue = $(this).attr('data-filter');
                $topeContainer.isotope({filter: filterValue});
            });

        });

        // init Isotope
        $(window).on('load', function () {
            var $grid = $topeContainer.each(function () {
                $(this).isotope({
                    itemSelector: '.isotope-item',
                    layoutMode: 'fitRows',
                    percentPosition: true,
                    animationEngine : 'best-available',
                    masonry: {
                        columnWidth: '.isotope-item'
                    }
                });
            });
        });

        var isotopeButton = $('.filter-tope-group button');

        $(isotopeButton).each(function(){
            $(this).on('click', function(){
                for(var i=0; i<isotopeButton.length; i++) {
                    $(isotopeButton[i]).removeClass('how-active1');
                }

                $(this).addClass('how-active1');
            });
        });
    </script>
    <script>
         function cancelFullScreen(el) {
            var requestMethod = el.cancelFullScreen||el.webkitCancelFullScreen||el.mozCancelFullScreen||el.exitFullscreen;
            if (requestMethod) { // cancel full screen.
                requestMethod.call(el);
            } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
                var wscript = new ActiveXObject("WScript.Shell");
                if (wscript !== null) {
                    wscript.SendKeys("{F11}");
                }
            }
        }

        function requestFullScreen(el) {
            // Supports most browsers and their versions.
            var requestMethod = el.requestFullScreen || el.webkitRequestFullScreen || el.mozRequestFullScreen || el.msRequestFullscreen;

            if (requestMethod) { // Native full screen.
                requestMethod.call(el);
            } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
                var wscript = new ActiveXObject("WScript.Shell");
                if (wscript !== null) {
                    wscript.SendKeys("{F11}");
                }
            }
            return false
        }
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\work\study\Complete-Ecommerce-in-laravel-10\resources\views/frontend/index.blade.php ENDPATH**/ ?>