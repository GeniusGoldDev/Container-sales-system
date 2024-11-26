
<header class="header shop">
    <!-- Topbar -->
    <div class="topbar header_topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- Top Left -->
                    <div class="top-left">
                        <ul class="list-main">
                            <li><i class="ti-headphone-alt"></i>+1 (774) 899-4671</li>
                            <li><i class="ti-email"></i> Canalbigmundi@gmail.com</li>
                        </ul>
                    </div>
                    <!--/ End Top Left -->
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- Top Right -->
                    <div class="right-content">
                        <ul class="list-main">
                            <?php if(auth()->guard()->check()): ?>
                                <?php if(Auth::user()->role=='admin'): ?>
                                    <li><i class="ti-user"></i> <a href="<?php echo e(route('admin')); ?>"  target="_blank">Dashboard</a></li>
                                <?php else: ?>

                                <?php endif; ?>
                                <li><i class="ti-power-off"></i> <a href="<?php echo e(route('user.logout')); ?>">Logout</a></li>

                            <?php else: ?>
                                <li><i class="ti-power-off"></i><a href="<?php echo e(route('login.form')); ?>">Login /</a> <a href="<?php echo e(route('register.form')); ?>">Register</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <!-- End Top Right -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    <div id="middle-inner" class="middle-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="<?php echo e(route('home')); ?>"><img src="<?php echo e(asset('images/logo.jpeg')); ?>" alt="logo"></a>
                    </div>
                    <!--/ End Logo -->
                    <!-- Search Form -->
                    <div class="search-top">
                        <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                        <!-- Search Form -->
                        <div class="search-top">
                            <form class="search-form">
                                <input type="text" placeholder="Search here..." name="search">
                                <button value="search" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                        <!--/ End Search Form -->
                    </div>
                    <!--/ End Search Form -->
                    <div class="mobile-nav"></div>
                </div>
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="search-bar-top">
                        <div class="search-bar">
                            <!-- <select>
                                <option >All Category</option>
                                <?php $__currentLoopData = Helper::getAllCategory(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option><?php echo e($cat->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select> -->
                            <form method="POST" action="<?php echo e(route('product.search')); ?>">
                                <?php echo csrf_field(); ?>
                                <input name="search" placeholder="Search Products Here....." type="search">
                                <button class="btnn" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">

                    <div class="right-bar">
                        <!-- Search Form -->
                        <div class="sinlge-bar shopping">

                        </div>
                    </div>
                    <div class="right-bar">
                        <!-- Search Form -->
                        <div class="sinlge-bar shopping">
                            <?php
                                $total_prod=0;
                                $total_amount=0;
                            ?>
                           <?php if(session('wishlist')): ?>
                                <?php $__currentLoopData = session('wishlist'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wishlist_items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $total_prod+=$wishlist_items['quantity'];
                                        $total_amount+=$wishlist_items['amount'];
                                    ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           <?php endif; ?>
                            <?php if(auth()->guard()->check()): ?>
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span><?php echo e(count(Helper::getAllProductFromWishlist())); ?> Items</span>
                                        <a href="<?php echo e(route('wishlist')); ?>">View Wishlist</a>
                                    </div>
                                    <ul class="shopping-list">
                                        
                                            <?php $__currentLoopData = Helper::getAllProductFromWishlist(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $photo=explode(',',$data->product['photo']);
                                                    ?>
                                                    <li>
                                                        <a href="<?php echo e(route('wishlist-delete',$data->id)); ?>" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                                        <a class="cart-img" href="#"><img src="<?php echo e($photo[0]); ?>" alt="<?php echo e($photo[0]); ?>"></a>
                                                        <h4><a href="<?php echo e(route('product-detail',$data->product['slug'])); ?>" target="_blank"><?php echo e($data->product['title']); ?></a></h4>
                                                        <p class="quantity"><?php echo e($data->quantity); ?> x - <span class="amount">$<?php echo e(number_format($data->price,2)); ?></span></p>
                                                    </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span class="total-amount">$<?php echo e(number_format(Helper::totalWishlistPrice(),2)); ?></span>
                                        </div>
                                        <a href="<?php echo e(route('cart')); ?>" class="btn animate">Cart</a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <!--/ End Shopping Item -->
                        </div>
                        <div class="sinlge-bar shopping">
                            <a href="<?php echo e(route('cart')); ?>" class="single-icon"><i class="ti-bag"></i> <span class="total-count"><?php echo e(Helper::cartCount()); ?></span></a>
                            <!-- Shopping Item -->
                            <?php if(auth()->guard()->check()): ?>
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span><?php echo e(count(Helper::getAllProductFromCart())); ?> Items</span>
                                        <a href="<?php echo e(route('cart')); ?>">View Cart</a>
                                    </div>
                                    <ul class="shopping-list">
                                        
                                            <?php $__currentLoopData = Helper::getAllProductFromCart(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $photo=explode(',',$data->product['photo']);
                                                    ?>
                                                    <li>
                                                        <a href="<?php echo e(route('cart-delete',$data->id)); ?>" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                                        <a class="cart-img" href="#"><img src="<?php echo e($photo[0]); ?>" alt="<?php echo e($photo[0]); ?>"></a>
                                                        <h4><a href="<?php echo e(route('product-detail',$data->product['slug'])); ?>" target="_blank"><?php echo e($data->product['title']); ?></a></h4>
                                                        <p class="quantity"><?php echo e($data->quantity); ?> x - <span class="amount">$<?php echo e(number_format($data->price,2)); ?></span></p>
                                                    </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span class="total-amount">$<?php echo e(number_format(Helper::totalCartPrice(),2)); ?></span>
                                        </div>
                                        <a href="<?php echo e(route('checkout')); ?>" class="btn animate">Checkout</a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <!--/ End Shopping Item -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">
                                    <div class="nav-inner">
                                        <ul class="nav main-menu menu navbar-nav">
                                            <li class="<?php echo e(Request::path()=='home' ? 'active' : ''); ?>"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('messages.Home')); ?></a></li>
                                            <li class="<?php echo e(Request::path()=='about-us' ? 'active' : ''); ?>"><a href="<?php echo e(route('about-us')); ?>"><?php echo e(__('messages.About Us')); ?></a></li>
                                            <li class="<?php if(Request::path()=='product-grids'||Request::path()=='product-lists'): ?>  active  <?php endif; ?>"><a href="<?php echo e(route('product-grids')); ?>"><?php echo e(__('messages.Products')); ?></a><span class="new">New</span></li>
                                                <!-- <?php echo e(Helper::getHeaderCategory()); ?> -->
                                            <li class="<?php echo e(Request::path()=='contact' ? 'active' : ''); ?>"><a href="<?php echo e(route('contact')); ?>"><?php echo e(__('messages.Contact Us')); ?> </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <!--/ End Main Menu -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>

<style>
    #middle-inner {
        background-image: url('/images/flag.png');
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>
<?php /**PATH E:\work\study\Complete-Ecommerce-in-laravel-10\resources\views/frontend/layouts/header.blade.php ENDPATH**/ ?>