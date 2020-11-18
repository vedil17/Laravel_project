@extends('layouts.app')

@section('title')
	Cart
@endsection

@section('content')

<div class="hero-wrap hero-bread" style="background-image: url('frontend/images/bg_1.jpg');">
  <div class="container">
	<div class="row no-gutters slider-text align-items-center justify-content-center">
	  <div class="col-md-9 ftco-animate text-center">
		  <p class="breadcrumbs"><span class="mr-2"><a href="{{URL::to('/')}}">Home</a></span> <span>Cart</span></p>
		<h1 class="mb-0 bread">My Cart</h1>
	  </div>
	</div>
  </div>
</div>
<?php
	$totalprice=0;
?>
@if (Session::has('cart'))
<section class="ftco-section ftco-cart">
	<div class="container">
		<div class="row">
		<div class="col-md-12 ftco-animate">
			<div class="cart-list">
				<table class="table">
					<thead class="thead-primary">
					  <tr class="text-center">
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>Product name</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Total</th>
					  </tr>
					</thead>
					<tbody>
					  
						@foreach ($products as $product)
							<tr class="text-center">
								<td class="product-remove"><a href="{{URL::to('/removeItem/'.$product['product_id'])}}"><span class="ion-ios-close"></span></a></td>
								
								<td class="image-prod"><div class="img" style="background-image:url({{asset('/storage/cover_image/'.$product['product_image'])}});"></div></td>
								
								<td class="product-name">
									<h3>{{$product['product_name']}}</h3>
									<p>Far far away, behind the word mountains, far from the countries</p>
								</td>
								
								<td class="price">${{$product['product_price']}}</td>
								{!! Form::open(['action'=>'ProductController@updateQty','method'=>'POST','class'=>'form-horizontal','enctype'=>'multipart/form-data'])!!}
                            		<fieldset>
									<td class="quantity">
										<div class="input-group mb-3">
										<input type="number" name="quantity" class="quantity form-control input-number" value="{{$product['qty']}}" min="1" max="100">
										<input id="cname" class="quantity form-control input-number" name="id"  type="hidden" value="{{$product['product_id']}}" >
									</div>
									{{Form::submit('Update',['class'=>'btn btn-success'])}}
									</fieldset>
								{{Form::close()}}
								
									
								</td>
								
								<td class="total">${{$product['product_price']*$product['qty']}}</td>
							</tr><!-- END TR-->
							<?php
								$totalprice+=$product['product_price']*$product['qty'];
							?>
					  @endforeach

					</tbody>
				  </table>
			  </div>
		</div>
	</div>
	<div class="row justify-content-end">
		<div class="col-lg-4 mt-5 cart-wrap ftco-animate">
			<div class="cart-total mb-3">
				<h3>Coupon Code</h3>
				<p>Enter your coupon code if you have one</p>
				  <form action="#" class="info">
		  <div class="form-group">
			  <label for="">Coupon code</label>
			<input type="text" class="form-control text-left px-3" placeholder="">
		  </div>
		</form>
			</div>
			<p><a href="checkout.html" class="btn btn-primary py-3 px-4">Apply Coupon</a></p>
		</div>
		<div class="col-lg-4 mt-5 cart-wrap ftco-animate">
			<div class="cart-total mb-3">
				<h3>Estimate shipping and tax</h3>
				<p>Enter your destination to get a shipping estimate</p>
				  <form action="#" class="info">
		  <div class="form-group">
			  <label for="">Country</label>
			<input type="text" class="form-control text-left px-3" placeholder="">
		  </div>
		  <div class="form-group">
			  <label for="country">State/Province</label>
			<input type="text" class="form-control text-left px-3" placeholder="">
		  </div>
		  <div class="form-group">
			  <label for="country">Zip/Postal Code</label>
			<input type="text" class="form-control text-left px-3" placeholder="">
		  </div>
		</form>
			</div>
			<p><a href="checkout.html" class="btn btn-primary py-3 px-4">Estimate</a></p>
		</div>
		<div class="col-lg-4 mt-5 cart-wrap ftco-animate">
			<div class="cart-total mb-3">
				<h3>Cart Totals</h3>
				<p class="d-flex total-price">
					<span>Total</span>
					<span>${{$totalprice}}</span>
				</p>
			</div>
			<p><a href="{{URL::to('/checkout')}}" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
		</div>
	</div>
	</div>
</section>
@else
	
@endif

	<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
  <div class="container py-4">
	<div class="row d-flex justify-content-center py-5">
	  <div class="col-md-6">
		  <h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
		  <span>Get e-mail updates about our latest shops and special offers</span>
	  </div>
	  <div class="col-md-6 d-flex align-items-center">
		<form action="#" class="subscribe-form">
		  <div class="form-group d-flex">
			<input type="text" class="form-control" placeholder="Enter email address">
			<input type="submit" value="Subscribe" class="submit px-3">
		  </div>
		</form>
	  </div>
	</div>
  </div>
</section>
<footer class="ftco-footer ftco-section">
  <div class="container">
	  <div class="row">
		  <div class="mouse">
					<a href="#" class="mouse-icon">
						<div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
					</a>
				</div>
	  </div>
	<div class="row mb-5">
	  <div class="col-md">
		<div class="ftco-footer-widget mb-4">
		  <h2 class="ftco-heading-2">Vegefoods</h2>
		  <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
		  <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
			<li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
			<li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
			<li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
		  </ul>
		</div>
	  </div>
	  <div class="col-md">
		<div class="ftco-footer-widget mb-4 ml-md-5">
		  <h2 class="ftco-heading-2">Menu</h2>
		  <ul class="list-unstyled">
			<li><a href="#" class="py-2 d-block">Shop</a></li>
			<li><a href="#" class="py-2 d-block">About</a></li>
			<li><a href="#" class="py-2 d-block">Journal</a></li>
			<li><a href="#" class="py-2 d-block">Contact Us</a></li>
		  </ul>
		</div>
	  </div>
	  <div class="col-md-4">
		 <div class="ftco-footer-widget mb-4">
		  <h2 class="ftco-heading-2">Help</h2>
		  <div class="d-flex">
			  <ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
				<li><a href="#" class="py-2 d-block">Shipping Information</a></li>
				<li><a href="#" class="py-2 d-block">Returns &amp; Exchange</a></li>
				<li><a href="#" class="py-2 d-block">Terms &amp; Conditions</a></li>
				<li><a href="#" class="py-2 d-block">Privacy Policy</a></li>
			  </ul>
			  <ul class="list-unstyled">
				<li><a href="#" class="py-2 d-block">FAQs</a></li>
				<li><a href="#" class="py-2 d-block">Contact</a></li>
			  </ul>
			</div>
		</div>
	  </div>
	  <div class="col-md">
		<div class="ftco-footer-widget mb-4">
			<h2 class="ftco-heading-2">Have a Questions?</h2>
			<div class="block-23 mb-3">
			  <ul>
				<li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
				<li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
				<li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
			  </ul>
			</div>
		</div>
	  </div>
	</div>
	<div class="row">
	  <div class="col-md-12 text-center">

		<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
					  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					</p>
	  </div>
	</div>
  </div>
</footer>



<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


<script>
	$(document).ready(function(){

	var quantitiy=0;
	   $('.quantity-right-plus').click(function(e){
			
			// Stop acting like a button
			e.preventDefault();
			// Get the field name
			var quantity = parseInt($('#quantity').val());
			
			// If is not undefined
				
				$('#quantity').val(quantity + 1);

			  
				// Increment
			
		});

		 $('.quantity-left-minus').click(function(e){
			// Stop acting like a button
			e.preventDefault();
			// Get the field name
			var quantity = parseInt($('#quantity').val());
			
			// If is not undefined
		  
				// Increment
				if(quantity>0){
				$('#quantity').val(quantity - 1);
				}
		});
		
	});
</script>

@endsection