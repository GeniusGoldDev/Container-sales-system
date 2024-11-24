
<?php $__env->startSection('title','Cart Page'); ?>
<?php $__env->startSection('main-content'); ?>
	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="<?php echo e(('home')); ?>">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="">Cart</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->

	<!-- Shopping Cart -->
	<div class="shopping-cart section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<!-- Shopping Summery -->
					<table class="table shopping-summery">
						<thead>
							<tr class="main-hading">
								<th>PRODUCT</th>
								<th>NAME</th>
								<th class="text-center">UNIT PRICE</th>
								<th class="text-center">QUANTITY</th>
								<th class="text-center">TOTAL</th>
								<th class="text-center"><i class="ti-trash remove-icon"></i></th>
							</tr>
						</thead>
						<tbody id="cart_item_list">
							<form action="<?php echo e(route('cart.update')); ?>" method="POST">
								<?php echo csrf_field(); ?>
								<?php if(Helper::getAllProductFromCart()): ?>
									<?php $__currentLoopData = Helper::getAllProductFromCart(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr>
											<?php
											$photo=explode(',',$cart->product['photo']);
											?>
											<td class="image" data-title="No"><img src="<?php echo e($photo[0]); ?>" alt="<?php echo e($photo[0]); ?>"></td>
											<td class="product-des" data-title="Description">
												<p class="product-name"><a href="<?php echo e(route('product-detail',$cart->product['slug'])); ?>" target="_blank"><?php echo e($cart->product['title']); ?></a></p>
												<p class="product-des"><?php echo ($cart['summary']); ?></p>
											</td>
											<td class="price" data-title="Price"><span>$<?php echo e(number_format($cart['price'],2)); ?></span></td>
											<td class="qty" data-title="Qty"><!-- Input Order -->
												<div class="input-group">
													<div class="button minus">
														<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[<?php echo e($key); ?>]">
															<i class="ti-minus"></i>
														</button>
													</div>
													<input type="text" name="quant[<?php echo e($key); ?>]" class="input-number"  data-min="1" data-max="100" value="<?php echo e($cart->quantity); ?>">
													<input type="hidden" name="qty_id[]" value="<?php echo e($cart->id); ?>">
													<div class="button plus">
														<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[<?php echo e($key); ?>]">
															<i class="ti-plus"></i>
														</button>
													</div>
												</div>
												<!--/ End Input Order -->
											</td>
											<td class="total-amount cart_single_price" data-title="Total"><span class="money">$<?php echo e($cart['amount']); ?></span></td>

											<td class="action" data-title="Remove"><a href="<?php echo e(route('cart-delete',$cart->id)); ?>"><i class="ti-trash remove-icon"></i></a></td>
										</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<track>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td class="float-right">
											<button class="btn float-right" type="submit">Update</button>
										</td>
									</track>
								<?php else: ?>
										<tr>
											<td class="text-center">
												There are no any carts available. <a href="<?php echo e(route('product-grids')); ?>" style="color:blue;">Continue shopping</a>

											</td>
										</tr>
								<?php endif; ?>

							</form>
						</tbody>
					</table>
					<!--/ End Shopping Summery -->
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<!-- Total Amount -->
					<div class="total-amount">
						<div class="row">
							<div class="col-lg-8 col-md-5 col-12">
								<div class="left">
									<div class="coupon">
									<form action="<?php echo e(route('coupon-store')); ?>" method="POST">
											<?php echo csrf_field(); ?>
											<input name="code" placeholder="Enter Your Coupon">
											<button class="btn">Apply</button>
										</form>
									</div>
									
								</div>
							</div>
							<div class="col-lg-4 col-md-7 col-12">
								<div class="right">
									<ul>
										<li class="order_subtotal" data-price="<?php echo e(Helper::totalCartPrice()); ?>">Cart Subtotal<span>$<?php echo e(number_format(Helper::totalCartPrice(),2)); ?></span></li>

										<?php if(session()->has('coupon')): ?>
										<li class="coupon_price" data-price="<?php echo e(Session::get('coupon')['value']); ?>">You Save<span>$<?php echo e(number_format(Session::get('coupon')['value'],2)); ?></span></li>
										<?php endif; ?>
										<?php
											$total_amount=Helper::totalCartPrice();
											if(session()->has('coupon')){
												$total_amount=$total_amount-Session::get('coupon')['value'];
											}
										?>
										<?php if(session()->has('coupon')): ?>
											<li class="last" id="order_total_price">You Pay<span>$<?php echo e(number_format($total_amount,2)); ?></span></li>
										<?php else: ?>
											<li class="last" id="order_total_price">You Pay<span>$<?php echo e(number_format($total_amount,2)); ?></span></li>
										<?php endif; ?>
									</ul>
									<div class="button5">
										<a href="<?php echo e(route('checkout')); ?>" class="btn">Checkout</a>
										<a href="<?php echo e(route('product-grids')); ?>" class="btn">Continue shopping</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--/ End Total Amount -->
				</div>
			</div>
		</div>
	</div>
	<!--/ End Shopping Cart -->

	<!-- Start Shop Services Area  -->
	<section class="shop-services section">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-rocket"></i>
						<h4>Free shiping</h4>
						<p>Orders over $100</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-reload"></i>
						<h4>Free Return</h4>
						<p>Within 30 days returns</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-lock"></i>
						<h4>Sucure Payment</h4>
						<p>100% secure payment</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-tag"></i>
						<h4>Best Peice</h4>
						<p>Guaranteed price</p>
					</div>
					<!-- End Single Service -->
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Newsletter -->

	<!-- Start Shop Newsletter  -->
	<?php echo $__env->make('frontend.layouts.newsletter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<!-- End Shop Newsletter -->

<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
	<style>
		li.shipping{
			display: inline-flex;
			width: 100%;
			font-size: 14px;
		}
		li.shipping .input-group-icon {
			width: 100%;
			margin-left: 10px;
		}
		.input-group-icon .icon {
			position: absolute;
			left: 20px;
			top: 0;
			line-height: 40px;
			z-index: 3;
		}
		.form-select {
			height: 30px;
			width: 100%;
		}
		.form-select .nice-select {
			border: none;
			border-radius: 0px;
			height: 40px;
			background: #f6f6f6 !important;
			padding-left: 45px;
			padding-right: 40px;
			width: 100%;
		}
		.list li{
			margin-bottom:0 !important;
		}
		.list li:hover{
			background:#F7941D !important;
			color:white !important;
		}
		.form-select .nice-select::after {
			top: 14px;
		}
	</style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
	<script src="<?php echo e(asset('frontend/js/nice-select/js/jquery.nice-select.min.js')); ?>"></script>
	<script src="<?php echo e(asset('frontend/js/select2/js/select2.min.js')); ?>"></script>
	<script>
		$(document).ready(function() { $("select.select2").select2(); });
  		$('select.nice-select').niceSelect();
	</script>
	<script>
		$(document).ready(function(){
			$('.shipping select[name=shipping]').change(function(){
				let cost = parseFloat( $(this).find('option:selected').data('price') ) || 0;
				let subtotal = parseFloat( $('.order_subtotal').data('price') );
				let coupon = parseFloat( $('.coupon_price').data('price') ) || 0;
				// alert(coupon);
				$('#order_total_price span').text('$'+(subtotal + cost-coupon).toFixed(2));
			});

		});

	</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\work\study\Complete-Ecommerce-in-laravel-10\resources\views/frontend/pages/cart.blade.php ENDPATH**/ ?>