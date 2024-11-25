<?php $__env->startSection('title','E-SHOP || About Us'); ?>

<?php $__env->startSection('main-content'); ?>

	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="index1.html">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="blog-single.html">About Us</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->

	<!-- About Us -->
	<section class="about-us section">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-12">
						<div class="about-content">
							<?php
								$settings=DB::table('settings')->get();
							?>
							<h3>Welcome To <span>CONTAINER_SHOP</span></h3>
							<p>Our containers are designed to provide durability, versatility, and reliability for a wide range of applications. Crafted from high-quality materials, they ensure long-term protection for your goods, whether you're using them for storage, shipping, or customized projects. With options ranging from standard sizes to tailored solutions, our containers adapt to your needs, making them the perfect choice for businesses and individuals alike. We’re committed to delivering innovative container solutions that combine practicality with affordability. Let us help you build, store, or transport with confidence!</p>
							<div class="button">
								<a href="<?php echo e(route('blog')); ?>" class="btn">Our Blog</a>
								<a href="<?php echo e(route('contact')); ?>" class="btn primary">Contact Us</a>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-12">
						<div class="about-img overlay">
                            <img src="<?php echo e(asset('images/chuttersnap-eqwFWHfQipg-unsplash.jpg')); ?>" alt="Container Image">
						</div>
					</div>
				</div>
			</div>
	</section>
	<!-- End About Us -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\work\study\Complete-Ecommerce-in-laravel-10\resources\views/frontend/pages/about-us.blade.php ENDPATH**/ ?>