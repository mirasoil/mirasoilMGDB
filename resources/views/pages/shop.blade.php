@extends('layouts.master')
@section('title')
<title>{{ __('Shop') }} - Mirasoil</title>
@endsection
@section('extra-scripts')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
@endsection
@section('content')
@if (session()->has('success_message'))
	<div class="alert alert-success">
		<p class="shop-success">{{ session()->get('success_message') }}</p>
	</div>
@endif

@if(count($errors) > 0)
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
<div class="container">
	<div class="row" id="shop">
		<div class="col-lg-12 col-sm-12 col-12 main-section">
			<div class="dropdown" id="dropdown-cart">
				<button type="button" class="btn btn-info" data-toggle="dropdown" id="cart-button">
					<i class="fa fa-shopping-cart" aria-hidden="true"></i> {{ __('Cart') }} <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
				</button>
			<div class="dropdown-menu" id="dropdown-cart-menu">
				<div class="row total-header-section">
					<div class="col-lg-6 col-sm-6 col-6">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
					</div>
					<?php $total = 0 ?>
					@foreach((array) session('cart') as $id => $details)
						<?php $total += $details['price'] * $details['quantity'] ?>
					@endforeach
					<div class="col-lg-6 col-sm-6 col-6 total-section text-right">
						<p>{{ __('Total') }}: <span class="text-info">{{ $total }} lei</span></p>
					</div>
				</div>
				@if(session('cart'))
					@foreach(session('cart') as $id => $details)
						<div class="row cart-detail">
							<div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
								<img src="../img/{{$details['image']}}" width="100" height="100"/>
							</div>
							<div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
								<p>{{ $details['name'] }}</p>
								<p class="text-muted small">{{ __('Quantity') }}: <span class="price text-info">{{ $details['quantity'] }} buc</span></p>
								<p class="text-muted small">{{ __('Unit price') }}: <span class="price text-info">{{ $details['price'] }} RON</span></p>
							</div>
						</div>
					@endforeach
				@endif
				<div class="row">
					<div class="col-lg-12 col-sm-12 col-12 text-center checkout">
						<a href="{{ url(app()->getLocale().'/cart') }}" class="btn btn-primary btn-block">{{ __('See cart') }}</a>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>
<div class="alert d-none">
	<p class="shop-success"></p>
</div>
<div class="container d-flex justify-content-center mt-2 mb-5">
    <div class="row">
    @if (count($products) > 0)
		@foreach($products as $product)
        <div class="d-none">{{ ++$i }}</div>
        <div class="col-md-4 mt-4">
            <div class="card shadow rounded">
                <div class="card-body">
                    <div class="card-img-actions"> <a href="{{ url(app()->getLocale().'/details', $product->slug) }}">
						<img src="../img/{{$product->image}}" class="card-img" width="96" height="350" alt="{{ $product->name }}"> </a>
					</div>
                </div>
                <div class="card-body bg-light text-center">
                    <div class="mb-2">
                        <h4 class="font-weight-semibold mb-2"> <a href="{{ url(app()->getLocale().'/details', $product->slug) }}" class="text-default mb-2" data-abc="true" style="text-decoration:none;color:black;">
							{{ $product->name }}</a> 
						</h4>
                        <p class="text-muted font-italic" style="font-size:15px;">{!! Str::limit($product->description, 70) !!}</p>
                    </div>
                    <h5 class="mb-0 font-weight-semibold">{{ $product->price }} RON</h5>
                    @if(Auth::guard('user')->check())
				    <button  type="button" class="btn btn-info btn-block text-center mt-4" id="{{$product->id}}" onclick="btnAddCart(this.id)">{{ __('Add to cart') }}</button>
                    @else
                    <a href="{{ route('login.default', app()->getLocale(), [session(['shop-session' => 'shop-session'])] ) }}" style="text-decoration:none;">
                        <button type="button" class="btn btn-info btn-block text-center mt-4" id="{{$product->id}}">{{ __('Add to cart') }}</button>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
        @endif     
    </div>
</div>
<div class="float-right mt-5">{{$products->render()}}</div><br>
<div class="mt-5"></div>
</div>
<script>
function btnAddCart(param) {
  let currentUrl = "{{ url(app()->getLocale().'/shop') }}";
  var product = param;
  var url = "{{ url(app()->getLocale().'/add-to-cart/') }}"+'/'+product;

  axios
   .post(url, {
    data: { 
		_token: '{{ csrf_token() }}',
        "product": product
	 }
   })
   .then(response => {
		// $('#shop').load(currentUrl+' #shop');  
		$("#shop").load(" #shop > *");  
		// $("#shop").css({"margin-left":"80%"});
		$(".alert").removeClass("d-none").addClass("alert alert-success");
		$('.shop-success').html('Produs adăugat în coș!');
   })
   .catch(function (error) {
    	console.log(error);
  })
  }
</script>
@endsection




