<?php $__env->startSection('meta'); ?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="keywords" content="online shop, purchase, cart, ecommerce site, best online shopping">
	<meta name="description" content="<?php echo e($product_detail->summary); ?>">
	<meta property="og:url" content="<?php echo e(route('product-detail',$product_detail->slug)); ?>">
	<meta property="og:type" content="article">
	<meta property="og:title" content="<?php echo e($product_detail->title); ?>">
	<meta property="og:image" content="<?php echo e($product_detail->photo); ?>">
	<meta property="og:description" content="<?php echo e($product_detail->description); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title','E-SHOP || PRODUCT DETAIL'); ?>
<?php $__env->startSection('main-content'); ?>

		<!-- Breadcrumbs -->
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<ul class="bread-list">
								<li><a href="<?php echo e(route('home')); ?>">Home<i class="ti-arrow-right"></i></a></li>
								<li class="active"><a href="">Shop Details</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->

		<!-- Shop Single -->
		<section class="shop single section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <!-- Product Slider -->
                                <div class="product-gallery">
                                    <!-- Images slider -->
                                    <div class="flexslider-thumbnails">
                                        <ul class="slides">
                                            <?php
                                                $photo=explode(',',$product_detail->photo);
                                            // dd($photo);
                                            ?>
                                            <?php $__currentLoopData = $photo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li data-thumb="<?php echo e($data); ?>" rel="adjustX:10, adjustY:">
                                                    <img src="<?php echo e($data); ?>" alt="<?php echo e($data); ?>">
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                    <!-- End Images slider -->
                                </div>
                                <!-- End Product slider -->
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="product-des">
                                    <!-- Description -->
                                    <div class="short">
                                        <h4><?php echo e($product_detail->title); ?></h4>
                                        <div class="rating-main">
                                            <ul class="rating">
                                                <?php
                                                    $rate=ceil($product_detail->getReview->avg('rate'))
                                                ?>
                                                    <?php for($i=1; $i<=5; $i++): ?>
                                                        <?php if($rate>=$i): ?>
                                                            <li><i class="fa fa-star"></i></li>
                                                        <?php else: ?>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                        <?php endif; ?>
                                                    <?php endfor; ?>
                                            </ul>
                                            <a href="#" class="total-review">(<?php echo e($product_detail['getReview']->count()); ?>) Review</a>
                                        </div>
                                        <?php
                                            $after_discount=($product_detail->price-(($product_detail->price*$product_detail->discount)/100));
                                        ?>
                                        <p class="price"><span class="discount">$<?php echo e(number_format($after_discount,2)); ?></span><s>$<?php echo e(number_format($product_detail->price,2)); ?></s> </p>
                                        <p class="description"></p>
                                        <div class="form-group">
                                            <div style="float: left; margin-bottom: 0.75rem;">
                                                <input class="custom-input" id="zip-input" type="text" placeholder="Enter your zip code">
                                                <div class="err err-init" id="zip-input-err">Invalid Zip Code</div>
                                            </div>
                                            <button class="btn custom-btn" id='zip-button'>Confirm</button>
                                        </div>

                                        <div class="form-group" style="background-color: #efefef; padding: 20px;">
                                            <div>Choose a delivery option</div>
                                            <div class="divider"></div>
                                            <label>
                                                <input type="radio" name="delivery-option" class="custom-radio" data="delivery-tilbed" value="tilt-bed" checked>
                                                Tilt bed delivery service. No offloading equipment needed.
                                            </label>
                                            <br>
                                            <label>
                                                <input type="radio" name="delivery-option" class="custom-radio" data="delivery-flatbed" value="flatbed">
                                                Flatbed delivery service. You will require your own offloading equipment.
                                            </label>
                                            <br>
                                            <label>
                                                <input type="radio" name="delivery-option" class="custom-radio" data="delivery-pickup" value="pickup">
                                                Pick up (free)
                                            </label>
                                        </div>

                                    </div>
                                    <!--/ End Description -->
                                    <!-- Color -->
                                    
                                    <!--/ End Color -->
                                    <!-- Size -->
                                    
                                    <!--/ End Size -->
                                    <!-- Product Buy -->
                                    <div class="product-buy">
                                        <form action="<?php echo e(route('single-add-to-cart')); ?>" method="POST" id="add-form" class="dis-init">
                                            <?php echo csrf_field(); ?>
                                            <div class="row p-3 w-75">
                                                <input type="hidden" id="zip-shipping">
                                                <div class="col-12">
                                                    From <b id="zip-start">LA, CA, USA</b>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-12 text-end">
                                                    To <b id="zip-end">90210, Los Angeles, Los Angeles County, California, United States</b>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-12 d-flex justify-content-between">
                                                    <p>Distance: </p><b id="zip-distance"></b>
                                                </div>
                                                <div class="col-12 d-flex justify-content-between">
                                                    <p>Container(<span id="container-qty"></span> X <span>$<?php echo e($product_detail['price']); ?></span>): </p><b id="zip-container"></b>
                                                </div>
                                                <div class="col-12 d-flex justify-content-between">
                                                    <p>Product discount: </p><b style="color: green;" id="zip-discount"></b>
                                                </div>
                                                <div class="col-12 d-flex justify-content-between">
                                                    <p>Shipping Price: </p><b id="zip-ship"></b>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-12 d-flex justify-content-between">
                                                    <p>Total Price: </p><b id="zip-total"></b>
                                                </div>
                                            </div>
                                            <div class="quantity">
                                                <h6>Quantity :</h6>
                                                <!-- Input Order -->
                                                <div class="input-group">
                                                    <div class="button minus">
                                                        <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                                            <i class="ti-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input type="hidden" name="slug" value="<?php echo e($product_detail->slug); ?>">
                                                    <input type="text" name="quant[1]" class="input-number"  data-min="1" data-max="1000" value="1" id="quantity">
                                                    <div class="button plus">
                                                        <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
                                                            <i class="ti-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            <!--/ End Input Order -->
                                            </div>
                                            <div class="add-to-cart mt-4">
                                                <button type="submit" class="btn">Add to cart</button>
                                                <a href="<?php echo e(route('add-to-wishlist',$product_detail->slug)); ?>" class="btn min"><i class="ti-heart"></i></a>
                                            </div>
                                        </form>

                                        <p class="cat">Category :<a href="<?php echo e(route('product-cat',$product_detail->cat_info['slug'])); ?>"><?php echo e($product_detail->cat_info['title']); ?></a></p>
                                        <?php if($product_detail->sub_cat_info): ?>
                                        <p class="cat mt-1">Sub Category :<a href="<?php echo e(route('product-sub-cat',[$product_detail->cat_info['slug'],$product_detail->sub_cat_info['slug']])); ?>"><?php echo e($product_detail->sub_cat_info['title']); ?></a></p>
                                        <?php endif; ?>
                                        <p class="availability">Stock : <?php if($product_detail->stock>0): ?><span class="badge badge-success"><?php echo e($product_detail->stock); ?></span><?php else: ?> <span class="badge badge-danger"><?php echo e($product_detail->stock); ?></span>  <?php endif; ?></p>
                                    </div>
                                    <!--/ End Product Buy -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="product-info">
                                    <div class="nav-main">
                                        <!-- Tab Nav -->
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a></li>
                                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews</a></li>
                                        </ul>
                                        <!--/ End Tab Nav -->
                                    </div>
                                    <div class="tab-content" id="myTabContent">
                                        <!-- Description Tab -->
                                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                                            <div class="tab-single">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="single-des">
                                                            <p><?php echo ($product_detail->description); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/ End Description Tab -->
                                        <!-- Reviews Tab -->
                                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                                            <div class="tab-single review-panel">
                                                <div class="row">
                                                    <div class="col-12">

                                                        <!-- Review -->
                                                        <div class="comment-review">
                                                            <div class="add-review">
                                                                <h5>Add A Review</h5>
                                                                <p>Your email address will not be published. Required fields are marked</p>
                                                            </div>
                                                            <h4>Your Rating <span class="text-danger">*</span></h4>
                                                            <div class="review-inner">
                                                                    <!-- Form -->
                                                        <?php if(auth()->guard()->check()): ?>
                                                        <form class="form" method="post" action="<?php echo e(route('review.store',$product_detail->slug)); ?>">
                                                            <?php echo csrf_field(); ?>
                                                            <div class="row">
                                                                <div class="col-lg-12 col-12">
                                                                    <div class="rating_box">
                                                                            <div class="star-rating">
                                                                            <div class="star-rating__wrap">
                                                                                <input class="star-rating__input" id="star-rating-5" type="radio" name="rate" value="5">
                                                                                <label class="star-rating__ico fa fa-star-o" for="star-rating-5" title="5 out of 5 stars"></label>
                                                                                <input class="star-rating__input" id="star-rating-4" type="radio" name="rate" value="4">
                                                                                <label class="star-rating__ico fa fa-star-o" for="star-rating-4" title="4 out of 5 stars"></label>
                                                                                <input class="star-rating__input" id="star-rating-3" type="radio" name="rate" value="3">
                                                                                <label class="star-rating__ico fa fa-star-o" for="star-rating-3" title="3 out of 5 stars"></label>
                                                                                <input class="star-rating__input" id="star-rating-2" type="radio" name="rate" value="2">
                                                                                <label class="star-rating__ico fa fa-star-o" for="star-rating-2" title="2 out of 5 stars"></label>
                                                                                <input class="star-rating__input" id="star-rating-1" type="radio" name="rate" value="1">
                                                                                <label class="star-rating__ico fa fa-star-o" for="star-rating-1" title="1 out of 5 stars"></label>
                                                                                <?php $__errorArgs = ['rate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                <span class="text-danger"><?php echo e($message); ?></span>
                                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                            </div>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 col-12">
                                                                    <div class="form-group">
                                                                        <label>Write a review</label>
                                                                        <textarea name="review" rows="6" placeholder="" ></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 col-12">
                                                                    <div class="form-group button5">
                                                                        <button type="submit" class="btn">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <?php else: ?>
                                                        <p class="text-center p-5">
                                                            You need to <a href="<?php echo e(route('login.form')); ?>" style="color:rgb(54, 54, 204)">Login</a> OR <a style="color:blue" href="<?php echo e(route('register.form')); ?>">Register</a>

                                                        </p>
                                                        <!--/ End Form -->
                                                        <?php endif; ?>
                                                            </div>
                                                        </div>

                                                        <div class="ratting-main">
                                                            <div class="avg-ratting">
                                                                
                                                                <h4><?php echo e(ceil($product_detail->getReview->avg('rate'))); ?> <span>(Overall)</span></h4>
                                                                <span>Based on <?php echo e($product_detail->getReview->count()); ?> Comments</span>
                                                            </div>
                                                            <?php $__currentLoopData = $product_detail['getReview']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <!-- Single Rating -->
                                                            <div class="single-rating">
                                                                <div class="rating-author">
                                                                    <?php if($data->user_info['photo']): ?>
                                                                    <img src="<?php echo e($data->user_info['photo']); ?>" alt="<?php echo e($data->user_info['photo']); ?>">
                                                                    <?php else: ?>
                                                                    <img src="<?php echo e(asset('backend/img/avatar.png')); ?>" alt="Profile.jpg">
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="rating-des">
                                                                    <h6><?php echo e($data->user_info['name']); ?></h6>
                                                                    <div class="ratings">

                                                                        <ul class="rating">
                                                                            <?php for($i=1; $i<=5; $i++): ?>
                                                                                <?php if($data->rate>=$i): ?>
                                                                                    <li><i class="fa fa-star"></i></li>
                                                                                <?php else: ?>
                                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                                <?php endif; ?>
                                                                            <?php endfor; ?>
                                                                        </ul>
                                                                        <div class="rate-count">(<span><?php echo e($data->rate); ?></span>)</div>
                                                                    </div>
                                                                    <p><?php echo e($data->review); ?></p>
                                                                </div>
                                                            </div>
                                                            <!--/ End Single Rating -->
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>

                                                        <!--/ End Review -->

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/ End Reviews Tab -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</section>
		<!--/ End Shop Single -->

    <!-- Modal -->
    <div class="modal fade" id="modelExample" tabindex="-1" role="dialog">
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
                                        <div class="single-slider">
                                            <img src="images/modal1.png" alt="#">
                                        </div>
                                        <div class="single-slider">
                                            <img src="images/modal2.png" alt="#">
                                        </div>
                                        <div class="single-slider">
                                            <img src="images/modal3.png" alt="#">
                                        </div>
                                        <div class="single-slider">
                                            <img src="images/modal4.png" alt="#">
                                        </div>
                                    </div>
                                </div>
                            <!-- End Product slider -->
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="quickview-content">
                                <h2>Flared Shift Dress</h2>
                                <div class="quickview-ratting-review">
                                    <div class="quickview-ratting-wrap">
                                        <div class="quickview-ratting">
                                            <i class="yellow fa fa-star"></i>
                                            <i class="yellow fa fa-star"></i>
                                            <i class="yellow fa fa-star"></i>
                                            <i class="yellow fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <a href="#"> (1 customer review)</a>
                                    </div>
                                    <div class="quickview-stock">
                                        <span><i class="fa fa-check-circle-o"></i> in stock</span>
                                    </div>
                                </div>
                                <h3>$29.00</h3>
                                <div class="quickview-peragraph">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia iste laborum ad impedit pariatur esse optio tempora sint ullam autem deleniti nam in quos qui nemo ipsum numquam.</p>
                                </div>
                                <div class="size">
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <h5 class="title">Size</h5>
                                            <select>
                                                <option selected="selected">s</option>
                                                <option>m</option>
                                                <option>l</option>
                                                <option>xl</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <h5 class="title">Color</h5>
                                            <select>
                                                <option selected="selected">orange</option>
                                                <option>purple</option>
                                                <option>black</option>
                                                <option>pink</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="quantity">
                                    <!-- Input Order -->
                                    <div class="input-group">
                                        <div class="button minus">
                                            <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                                <i class="ti-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" name="qty" class="input-number"  data-min="1" data-max="1000" value="1">
                                        <div class="button plus">
                                            <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
                                                <i class="ti-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!--/ End Input Order -->
                                </div>
                                <div class="add-to-cart">
                                    <a href="#" class="btn">Add to cart</a>
                                    <a href="#" class="btn min"><i class="ti-heart"></i></a>
                                    <a href="#" class="btn min"><i class="fa fa-compress"></i></a>
                                </div>
                                <div class="default-social">
                                    <h4 class="share-now">Share:</h4>
                                    <ul>
                                        <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a class="youtube" href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                        <li><a class="dribbble" href="#"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal end -->

<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
	<style>
		/* Rating */
		.rating_box {
		display: inline-flex;
		}

		.star-rating {
		font-size: 0;
		padding-left: 10px;
		padding-right: 10px;
		}

		.star-rating__wrap {
		display: inline-block;
		font-size: 1rem;
		}

		.star-rating__wrap:after {
		content: "";
		display: table;
		clear: both;
		}

		.star-rating__ico {
		float: right;
		padding-left: 2px;
		cursor: pointer;
		color: #F7941D;
		font-size: 16px;
		margin-top: 5px;
		}

		.star-rating__ico:last-child {
		padding-left: 0;
		}

		.star-rating__input {
		display: none;
		}

		.star-rating__ico:hover:before,
		.star-rating__ico:hover ~ .star-rating__ico:before,
		.star-rating__input:checked ~ .star-rating__ico:before {
		content: "\F005";
		}
        .shop.single .product-gallery .slides li img {
            height: 433px;
        }
        li img {
            height: 100px;
        }

	</style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

	<script>
		var zipCode = '';
		var pricePerContainer = <?php echo json_encode($product_detail['price'], 15, 512) ?>;
		pricePerContainer = parseFloat(pricePerContainer).toFixed(2);
		var discountPerContainer = <?php echo json_encode($product_detail['discount'], 15, 512) ?>;
        var pricePerMile = <?php echo json_encode($shippings, 15, 512) ?>;
        var shippingType = 'til_bed';
        var distance = 0.00;
        var shippingPrice = 0.00;
        var currentQty = 1;
        var containerPrice = 0.00;
        var containerDiscount = 0.00;
        var totalPrice = 0.00;
        var til_price = 0.00;
        var flat_price = 0.00;

        function convertFixed() {
            totalPrice = parseFloat(totalPrice).toFixed(2);
            containerPrice = parseFloat(containerPrice).toFixed(2);
            containerDiscount = parseFloat(containerDiscount).toFixed(2);
            shippingPrice = parseFloat(shippingPrice).toFixed(2);
        }

        for(var i=0; i<pricePerMile.length ; i++) {
            if(pricePerMile[i]['type'] === 'til_bed') {
                til_price = pricePerMile[i]['price'];
            } else if(pricePerMile[i]['type'] === 'flat_bed') {
                flat_price = pricePerMile[i]['price'];
            }
        }

		$('#zip-button').click(function() {
			zipCode = $('#zip-input').val();
			$.ajax({
                url:"<?php echo e(route('fetch-location')); ?>",
                type:"POST",
                data:{
                    _token:"<?php echo e(csrf_token()); ?>",
                    zipCode:zipCode,
                    shippingType: shippingType
                },
                success:function(response){
					$('#zip-input').removeClass('is-err');
					$('#zip-input-err').addClass('err-init');
					$('#add-form').removeClass('dis-init');
					if(typeof(response)!='object'){
						response=$.parseJSON(response);
					}
					if(response.status){
						console.log(response.msg);
						var data = response.msg;
						distance = data['distance'];
						shippingPrice = parseFloat(data.shippingPrice).toFixed(2);
						currentQty = $('#quantity').val();
						containerPrice = currentQty * pricePerContainer;
						containerDiscount = currentQty * discountPerContainer * pricePerContainer / 100;
						totalPrice = parseFloat(containerPrice) + parseFloat(shippingPrice) - parseFloat(containerDiscount);
						convertFixed();
						$('#zip-shipping').val(shippingPrice);
						$('#zip-start').text(data.depot);
						$('#zip-end').text(data.des);
						$('#zip-distance').text(distance + 'miles');
						$('#container-qty').text(currentQty);
						$('#zip-container').text('$' + containerPrice);
						$('#zip-discount').text('$' + containerDiscount);
						$('#zip-ship').text('$' + shippingPrice);
						$('#zip-total').text('$' + totalPrice);
					}
					else{
						$('#zip-input').addClass('is-err');
						$('#zip-input-err').removeClass('err-init');
						$('#add-form').addClass('dis-init');
                    }
                },
				error: function(xhr, status, error) {
					$('#zip-input').addClass('is-err');
					$('#zip-input-err').removeClass('err-init');
					$('#add-form').addClass('dis-init');
					// swal('Error', 'Invalid Zip Code', 'error');
				}
            })
		})
        $('input[type="radio"]').click(function() {
            var data = $(this).attr('data');
            switch(data) {
                case 'delivery-flatbed': shippingType = 'flat_bed'; break;
                case 'delivery-tilbed': shippingType = 'til_bed'; break;
                case 'delivery-pickup': shippingType = 'pickup'; break;
            }
            if(shippingType === 'til_bed') {
                if(distance > 80) {
                    shippingPrice = parseFloat(distance * til_price).toFixed(2);
                } else {
                    shippingPrice = 400.00;
                }
                totalPrice = parseFloat(containerPrice) + parseFloat(shippingPrice) - parseFloat(containerDiscount);
                convertFixed();
                $('#zip-ship').text('$' + shippingPrice);
                $('#zip-total').text('$' + totalPrice);
            } else if(shippingType === 'flat_bed') {
                if(distance > 80) {
                    shippingPrice = parseFloat(distance * flat_price).toFixed(2);
                } else {
                    shippingPrice = 400.00;
                }
                totalPrice = parseFloat(containerPrice) + parseFloat(shippingPrice) - parseFloat(containerDiscount);
                convertFixed();
                $('#zip-ship').text('$' + shippingPrice);
                $('#zip-total').text('$' + totalPrice);
            }
            else if(shippingType === 'pickup') {
                shippingPrice = 0.00;
                totalPrice = parseFloat(containerPrice) + parseFloat(shippingPrice) - parseFloat(containerDiscount);
                convertFixed();
                $('#zip-ship').text('$' + shippingPrice);
                $('#zip-total').text('$' + totalPrice);
            }
            console.log(shippingType);
        })
	</script>

    

<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\work\study\Complete-Ecommerce-in-laravel-10\resources\views/frontend/pages/product_detail.blade.php ENDPATH**/ ?>