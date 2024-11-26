@extends('frontend.layouts.master')

@section('meta')
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="keywords" content="online shop, purchase, cart, ecommerce site, best online shopping">
	<meta name="description" content="{{$product_detail->summary}}">
	<meta property="og:url" content="{{route('product-detail',$product_detail->slug)}}">
	<meta property="og:type" content="article">
	<meta property="og:title" content="{{$product_detail->title}}">
	<meta property="og:image" content="{{$product_detail->photo}}">
	<meta property="og:description" content="{{$product_detail->description}}">
@endsection
@section('title','E-SHOP || PRODUCT DETAIL')
@section('main-content')

		<!-- Breadcrumbs -->
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<ul class="bread-list">
								<li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
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
                                            @php
                                                $photo=explode(',',$product_detail->photo);
                                            // dd($photo);
                                            @endphp
                                            @foreach($photo as $data)
                                                <li data-thumb="{{$data}}" rel="adjustX:10, adjustY:">
                                                    <img src="{{$data}}" alt="{{$data}}">
                                                </li>
                                            @endforeach
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
                                        <h4>{{$product_detail->title}}</h4>
                                        <div class="rating-main">
                                            <ul class="rating">
                                                @php
                                                    $rate=ceil($product_detail->getReview->avg('rate'))
                                                @endphp
                                                    @for($i=1; $i<=5; $i++)
                                                        @if($rate>=$i)
                                                            <li><i class="fa fa-star"></i></li>
                                                        @else
                                                            <li><i class="fa fa-star-o"></i></li>
                                                        @endif
                                                    @endfor
                                            </ul>
                                            <a href="#" class="total-review">({{$product_detail['getReview']->count()}}) Review</a>
                                        </div>
                                        @php
                                            $after_discount=($product_detail->price-(($product_detail->price*$product_detail->discount)/100));
                                        @endphp
                                        <p class="price"><span class="discount">${{number_format($after_discount,2)}}</span><s>${{number_format($product_detail->price,2)}}</s> </p>
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
                                    {{-- <div class="color">
                                        <h4>Available Options <span>Color</span></h4>
                                        <ul>
                                            <li><a href="#" class="one"><i class="ti-check"></i></a></li>
                                            <li><a href="#" class="two"><i class="ti-check"></i></a></li>
                                            <li><a href="#" class="three"><i class="ti-check"></i></a></li>
                                            <li><a href="#" class="four"><i class="ti-check"></i></a></li>
                                        </ul>
                                    </div> --}}
                                    <!--/ End Color -->
                                    <!-- Size -->
                                    {{--
                                    @if($product_detail->size)
                                        <div class="size mt-4">
                                            <h4>Size</h4>
                                            <ul>
                                                @php
                                                    $sizes=explode(',',$product_detail->size);
                                                    // dd($sizes);
                                                @endphp
                                                @foreach($sizes as $size)
                                                <li><a href="#" class="one">{{$size}}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    --}}
                                    <!--/ End Size -->
                                    <!-- Product Buy -->
                                    <div class="product-buy">
                                        <form action="{{route('single-add-to-cart')}}" method="POST" id="add-form" class="dis-init">
                                            @csrf
                                            <div class="row p-3 w-75">
                                                <input type="hidden" id="zip-shipping">
                                                <div class="col-12 d-flex justify-content-between">
                                                    <p>From <b id="zip-start">LA, CA, USA</b></p>
                                                    <p data-toggle="modal" data-target="#other-depots-modal" id="other-depots" class="other-depots">Other depots</p>
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
                                                    <p>Container(<span id="container-qty"></span> X <span>${{$product_detail['price']}}</span>): </p><b id="zip-container"></b>
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
                                                    <input type="hidden" name="slug" value="{{$product_detail->slug}}">
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
                                                <!-- <a href="{{route('add-to-wishlist',$product_detail->slug)}}" class="btn min"><i class="ti-heart"></i></a> -->
                                            </div>
                                        </form>

                                        <p class="cat">Category :<a href="{{route('product-cat',$product_detail->cat_info['slug'])}}">{{$product_detail->cat_info['title']}}</a></p>
                                        @if($product_detail->sub_cat_info)
                                        <p class="cat mt-1">Sub Category :<a href="{{route('product-sub-cat',[$product_detail->cat_info['slug'],$product_detail->sub_cat_info['slug']])}}">{{$product_detail->sub_cat_info['title']}}</a></p>
                                        @endif
                                        <p class="availability">Stock : @if($product_detail->stock>0)<span class="badge badge-success">{{$product_detail->stock}}</span>@else <span class="badge badge-danger">{{$product_detail->stock}}</span>  @endif</p>
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
                                                            <p>{!! ($product_detail->description) !!}</p>
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
                                                        @auth
                                                        <form class="form" method="post" action="{{route('review.store',$product_detail->slug)}}">
                                                            @csrf
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
                                                                                @error('rate')
                                                                                <span class="text-danger">{{$message}}</span>
                                                                                @enderror
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
                                                        @else
                                                        <p class="text-center p-5">
                                                            You need to <a href="{{route('login.form')}}" style="color:rgb(54, 54, 204)">Login</a> OR <a style="color:blue" href="{{route('register.form')}}">Register</a>

                                                        </p>
                                                        <!--/ End Form -->
                                                        @endauth
                                                            </div>
                                                        </div>

                                                        <div class="ratting-main">
                                                            <div class="avg-ratting">
                                                                {{-- @php
                                                                    $rate=0;
                                                                    foreach($product_detail->rate as $key=>$rate){
                                                                        $rate +=$rate
                                                                    }
                                                                @endphp --}}
                                                                <h4>{{ceil($product_detail->getReview->avg('rate'))}} <span>(Overall)</span></h4>
                                                                <span>Based on {{$product_detail->getReview->count()}} Comments</span>
                                                            </div>
                                                            @foreach($product_detail['getReview'] as $data)
                                                            <!-- Single Rating -->
                                                            <div class="single-rating">
                                                                <div class="rating-author">
                                                                    @if($data->user_info['photo'])
                                                                    <img src="{{$data->user_info['photo']}}" alt="{{$data->user_info['photo']}}">
                                                                    @else
                                                                    <img src="{{asset('backend/img/avatar.png')}}" alt="Profile.jpg">
                                                                    @endif
                                                                </div>
                                                                <div class="rating-des">
                                                                    <h6>{{$data->user_info['name']}}</h6>
                                                                    <div class="ratings">

                                                                        <ul class="rating">
                                                                            @for($i=1; $i<=5; $i++)
                                                                                @if($data->rate>=$i)
                                                                                    <li><i class="fa fa-star"></i></li>
                                                                                @else
                                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                                @endif
                                                                            @endfor
                                                                        </ul>
                                                                        <div class="rate-count">(<span>{{$data->rate}}</span>)</div>
                                                                    </div>
                                                                    <p>{{$data->review}}</p>
                                                                </div>
                                                            </div>
                                                            <!--/ End Single Rating -->
                                                            @endforeach
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

		<!-- Start Most Popular -->
        <div class="product-area most-popular related-product section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2>Related Products</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- {{$product_detail->rel_prods}} --}}
                    <div class="col-12">
                        <div class="owl-carousel popular-slider">
                            @foreach($product_detail->rel_prods as $data)
                                @if($data->id !==$product_detail->id)
                                    <!-- Start Single Product -->
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="{{route('product-detail',$data->slug)}}">
                                                @php
                                                    $photo=explode(',',$data->photo);
                                                @endphp
                                                <img class="default-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                                <img class="hover-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                                <span class="price-dec">{{$data->discount}} % Off</span>
                                                                        {{-- <span class="out-of-stock">Hot</span> --}}
                                            </a>
                                            <div class="button-head">
                                                <div class="product-action">
                                                    <a data-toggle="modal" data-target="#modelExample" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                                                    <a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                                    <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
                                                </div>
                                                <div class="product-action-2">
                                                    <a title="Add to cart" href="#">Add to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h3><a href="{{route('product-detail',$data->slug)}}">{{$data->title}}</a></h3>
                                            <div class="product-price">
                                                @php
                                                    $after_discount=($data->price-(($data->discount*$data->price)/100));
                                                @endphp
                                                <span class="old">${{number_format($data->price,2)}}</span>
                                                <span>${{number_format($after_discount,2)}}</span>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- End Single Product -->

                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
	    <!-- End Most Popular Area -->

    <div class="modal" id="quote-modal" role="dialog">
        <div class=" row" role="document">
            <div class="modal-content col-12 col-md-10 col-lg-8  mx-auto" style="padding: 50px;">
                <div class="">
                    <h4 class="mb-2" style="color: #3131cf">Write a quote</h4>                                               
                    <h5 class="mb-2">Distance: <b id="modal-distance"></b> miles</h5>                                                
                </div>    
                <div class="divider"></div>       
                <form class="form-contact form contact_form" method="post" action="{{route('product.quote')}}" id="contactForm" novalidate="novalidate">
                    @csrf         
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label class="custom-label">Your Name<span class="custom-span">*</span></label>
                                <input class="custom-input" name="name" id="name" type="text" placeholder="Enter your name">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label class="custom-label">Your Surname<span class="custom-span">*</span></label>
                                <input class="custom-input" name="subject" type="text" id="subject" placeholder="Enter Surname">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label class="custom-label">Your Email<span class="custom-span">*</span></label>
                                <input class="custom-input" name="email" type="email" id="email" placeholder="Enter email address">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label class="custom-label">Your Phone<span class="custom-span">*</span></label>
                                <input class="custom-input" id="phone" name="phone" type="number" placeholder="Enter your phone">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label class="custom-label">Zip Code<span class="custom-span">*</span></label>
                                <input class="custom-input" id="zipcode" name="zipcode" type="number" placeholder="Enter your zipcode" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label class="custom-label">Quentity<span class="custom-span">*</span></label>
                                <input class="custom-input" id="qty" name="qty" type="number" placeholder="Enter your quantity" value='1'>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group message">
                                <label class="custom-label">your message<span class="custom-span">*</span></label>
                                <textarea class="custom-textarea" name="message" id="message" cols="30" rows="9" placeholder="Enter Message"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group button">
                                <button type="submit" data-bs-dismiss="modal" aria-label="Close" class="btn" >Send Message</button>
                                <button class="btn" id="quote-modal-close">Close</button>
                            </div>
                        </div>
                        <input type="hidden" id="">
                    </div>          
                </form>                                          
            </div>
        </div>                                                           
    </div>

    <div class="modal" id="other-depots-modal" role="dialog">
        <div class="modal-dialog row" role="document">
            <div class="modal-content p-3 col-12 col-md-10 col-lg-8  mx-auto">
                <div class="">
                    <h3>Select other depots</h3>                                               
                </div>    
                <div class="divider"></div>                
                <div class="modal-body" style="max-height: 500px !important;">
                    <h5 class="mb-4">Available depots</h5>
                    <div id="depots-container">

                    </div>
                </div>                               
            </div>
        </div>                                                           
    </div>

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

@endsection
@push('styles')
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

        .error {
            color: red;
        }
        .input.error {
            border-color: 2px solid red;
        }
	</style>
@endpush
@push('scripts')
<script src="{{ asset('frontend/js/jquery.form.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('frontend/js/contact.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

	<script>
		var zipCode = '';
		var pricePerContainer = @json($product_detail['price']);
		pricePerContainer = parseFloat(pricePerContainer).toFixed(2);
		var discountPerContainer = @json($product_detail['discount']);
        var pricePerMile = @json($shippings);
        var shippingType = 'til_bed';
        var categoryType = @json($product_detail['cat_id']);
        var distance = 0.00;
        var shippingPrice = 0.00;
        var currentQty = 1;
        var containerPrice = 0.00;
        var containerDiscount = 0.00;
        var totalPrice = 0.00;
        var til_price = 0.00;
        var flat_price = 0.00;
        var depot = '';
        var destination = '';
        
        if(categoryType == '17') {
            categoryType = 'worthy';
        } else {
            categoryType = 'normal';
        }
        function convertFixed() {
            totalPrice = parseFloat(totalPrice).toFixed(2);
            containerPrice = parseFloat(containerPrice).toFixed(2);
            containerDiscount = parseFloat(containerDiscount).toFixed(2);
            shippingPrice = parseFloat(shippingPrice).toFixed(2);
        }

        function setValue() {
            if(shippingType === 'til_bed') {
                if(distance > 80) {
                    shippingPrice = parseFloat(distance * til_price).toFixed(2);
                } else {
                    shippingPrice = 400.00;
                }
                containerDiscount = currentQty * discountPerContainer * pricePerContainer / 100;
                totalPrice = parseFloat(containerPrice) * parseFloat(currentQty) + parseFloat(shippingPrice) - parseFloat(containerDiscount);			
                convertFixed();
                $('#container-qty').text(currentQty);
                $('#zip-ship').text('$' + shippingPrice);
                $('#zip-discount').text('$' + containerDiscount);
                $('#zip-total').text('$' + totalPrice);
            } else if(shippingType === 'flat_bed') {
                if(distance > 80) {
                    shippingPrice = parseFloat(distance * flat_price).toFixed(2);
                } else {
                    shippingPrice = 400.00;
                }
                containerDiscount = currentQty * discountPerContainer * pricePerContainer / 100;
                totalPrice = parseFloat(containerPrice) * parseFloat(currentQty) + parseFloat(shippingPrice) - parseFloat(containerDiscount);
                convertFixed();
                $('#container-qty').text(currentQty);
                $('#zip-ship').text('$' + shippingPrice);
                $('#zip-discount').text('$' + containerDiscount);
                $('#zip-total').text('$' + totalPrice);
            }
            else if(shippingType === 'pickup') {
                shippingPrice = 0.00;
                containerDiscount = currentQty * discountPerContainer * pricePerContainer / 100;
                totalPrice = parseFloat(containerPrice) * parseFloat(currentQty) + parseFloat(shippingPrice) - parseFloat(containerDiscount);
                convertFixed();
                $('#container-qty').text(currentQty);
                $('#zip-ship').text('$' + shippingPrice);
                $('#zip-discount').text('$' + containerDiscount);
                $('#zip-total').text('$' + totalPrice);
            }
        }

        function ajaxSetValue() {
            containerPrice = currentQty * pricePerContainer;
            containerDiscount = currentQty * discountPerContainer * pricePerContainer / 100;
            totalPrice = parseFloat(containerPrice) + parseFloat(shippingPrice) - parseFloat(containerDiscount);
            convertFixed();
            $('#zip-shipping').val(shippingPrice);
            $('#zip-start').text(depot);
            $('#zip-end').text(destination);
            $('#zip-distance').text(distance + 'miles');
            $('#container-qty').text(currentQty);
            $('#zip-container').text('$' + containerPrice);
            $('#zip-discount').text('$' + containerDiscount);
            $('#zip-ship').text('$' + shippingPrice);
            $('#zip-total').text('$' + totalPrice);
        }

        function structureDepots(otherBases) {
            otherBases.forEach(function(base){
                var otherDepot = $(
                    `
                        <div class="other-bases" data-bs-dismiss="modal" aria-label="Close">
                            <div>Depot Name: <b>${base['depot']}</b></div>
                            <div>Distance: <b>${parseFloat(base['distance']).toFixed(2)}</b> <b>miles</b></div>
                        </div>
                    `
                )
                $('#depots-container').append(otherDepot);
            })
        }

        for(var i=0; i<pricePerMile.length ; i++) {
            if(pricePerMile[i]['type'] === 'til_bed') {
                til_price = pricePerMile[i]['price'];
            } else if(pricePerMile[i]['type'] === 'flat_bed') {
                flat_price = pricePerMile[i]['price'];
            }
        }

        $('#quantity').change(function() {
            console.log('changed');
            currentQty = $('#quantity').val();
            setValue();
            ajaxSetValue();
        })
        $('#qty').change(function() {
            console.log('ok');
            
        })

		$('#zip-button').click(function() {
			zipCode = $('#zip-input').val();
			$.ajax({
                url:"{{route('fetch-location')}}",
                type:"POST",
                data:{
                    _token:"{{csrf_token()}}",
                    zipCode:zipCode,
                    shippingType: shippingType,
                    categoryType: categoryType
                },
                success:function(response){
					$('#zip-input').removeClass('is-err');
					$('#zip-input-err').addClass('err-init');
					if(typeof(response)!='object'){
						response=$.parseJSON(response);
					}
					if(response.status){
						console.log(response.msg);
						var data = response.msg;
						distance = data['distance'];
                        if(distance > 300) {
                            $('#zipcode').val(zipCode);
                            $('#modal-distance').text(distance);
                            $('#quote-modal').modal('show');
                        } else {
                            $('#add-form').removeClass('dis-init');
                            shippingPrice = parseFloat(data.shippingPrice).toFixed(2);
                            currentQty = $('#quantity').val();
                            depot = data.depot;
                            destination = data.destination;
                            ajaxSetValue();
                            structureDepots(data.otherBases);
                        }
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
            currentQty = $('#quantity').val();
            setValue();
            console.log(shippingType);
        })
        $('#depots-container').on('click', '.other-bases', function() {
            var newDistance = 0.00;
            var newDepot = '';
            var newDepot = $(this).find('b').eq(0).text();
            console.log("First Child:", newDepot);
            var newDistance = $(this).find('b').eq(1).text();
            console.log("Second Child:", newDistance);
            depot = newDepot;
            distance = parseFloat(newDistance).toFixed(2);
            ajaxSetValue();
            setValue();
            $('#other-depots-modal').modal('hide'); // Closes the modal
        })
        $('#quote-modal-close').click(function() {
            $('#quote-modal').modal('hide');
        })
        
	</script>

    {{-- <script>
        $('.cart').click(function(){
            var quantity=$('#quantity').val();
            var pro_id=$(this).data('id');
            // alert(quantity);
            $.ajax({
                url:"{{route('add-to-cart')}}",
                type:"POST",
                data:{
                    _token:"{{csrf_token()}}",
                    quantity:quantity,
                    pro_id:pro_id
                },
                success:function(response){
                    console.log(response);
					if(typeof(response)!='object'){
						response=$.parseJSON(response);
					}
					if(response.status){
						swal('success',response.msg,'success').then(function(){
							document.location.href=document.location.href;
						});
					}
					else{
                        swal('error',response.msg,'error').then(function(){
							document.location.href=document.location.href;
						});
                    }
                }
            })
        });
    </script> --}}

@endpush
