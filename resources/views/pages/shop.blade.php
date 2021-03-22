@extends('layouts.master')
@section('title')
<title>Magazin - Mirasoil</title>
@endsection
@section('extra-scripts')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
					<i class="fa fa-shopping-cart" aria-hidden="true"></i>Coș<span class="badge badge-pill badge-danger">{{ Cart::count() }}</span>
				</button>
				<div class="dropdown-menu" id="dropdown-cart-menu">
					<div class="row total-header-section">
						<div class="col-lg-6 col-sm-6 col-6">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ Cart::count() }}</span>
						</div>
						<div class="col-lg-6 col-sm-6 col-6 total-section text-right">
							<p>Total: <span class="text-info">{{ Cart::subtotal() }} lei</span></p>
						</div>
					</div>
					@if(Cart::count() > 0)
						@foreach(Cart::content() as $details)
							<div class="row cart-detail">
								<div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
									<img src="../img/{!!$details->options->image!!}" width="100" height="100"/>
								</div>
								<div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
									<p>{{ $details->name }}</p>
									<p class="text-muted small">Cantitate: <span class="price text-info">{{ $details->qty }} buc</span></p>
									<p class="text-muted small">Preț/buc: <span class="price text-info">{{ $details->price }} RON</span></p>
								</div>
							</div>
						@endforeach
					@endif
					<div class="row">
						<div class="col-lg-12 col-sm-12 col-12 text-center checkout">
							<a href="{{ url(app()->getLocale().'/cart') }}" class="btn btn-primary btn-block">Vezi coș</a>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<div class="alert d-none">
		<p class="shop-success"></p>
	</div>
	<div class="card-deck justify-content-center">	
		@foreach($products as $product)
		<div class="d-none">{{ ++$i }}</div>
		<div class="ml-5 my-4 text-center shadow p-4 bg-white rounded" style="width: 23rem;">
			<a href="{{ url('details', $product->id) }}"><img class="card-img-top" src="../img/{{$product->image}}" height="320"></a>
			<div class="card-body text-center">
				<h4><a href="{{ url('details', $product->id) }}" style="text-decoration:none;color:black;">{{ $product->name }}</a></h4>
				<p>{!! Str::limit($product->description, 50) !!}</p>
				<p><strong>Pret: </strong> {{ $product->price }} RON</p>
			</div>
			@if(Auth::guard('user')->check())
				<button  class="btn btn-warning btn-block text-center" id="{{$product->id}}" onclick="btnAddCart(this.id)">Adaugă în coș</button>
			@else
				<button  class="btn btn-warning btn-block text-center" id="{{$product->id}}" onclick="location.href='/login/user'">Adaugă în coș</button><!---redirectare inapoi in cos --->
			@endif
			
		</div>
		@endforeach	
	</div>
	<div class="float-right mr-5 pr-5 mb-5">{{$products->render()}}</div><br>
</div>
<script>
function btnAddCart(param) {
  var product = param;
  var url = "/add-to-cart/"+product;

  $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  $.ajax({
    type: "POST",
    url: url,
    data: { 
        "product": product
	 },
	 success: function (response) {
			$('#shop').load('/shop #shop');    
			$("#shop").css({"margin-left":"80%"});
			$(".alert").removeClass("d-none").addClass("alert alert-success")  //stilizare
			$('.shop-success').html('Produs adaugat in cos');

    },
    error: function (response) {
      console.log('Error:', response);
    }
  });
};
</script>
@endsection