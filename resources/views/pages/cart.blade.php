@extends('layouts.master')
@section('title')
<title>{{ __('Cart') }} - Mirasoil</title>
@endsection
@section('extra-scripts')
<!--Axios-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
@endsection
@section('content')
<div class="container">
    <nav aria-label="breadcrumb" class="main-breadcrumb mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/user') }}">{{ __('My Account') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/shop') }}">{{ __('Shop') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('My Cart') }}</li>
        </ol>
    </nav>
 @if (\Session::has('cart-success'))
<div class="alert alert-success">
    <h6 id="message-response">{{ \Session::get('cart-success') }}</h6>
</div>
@endif
@if (\Session::has('cart-failure'))
<div class="alert alert-danger">
    <h6 id="message-response">{{ \Session::get('cart-failure') }}</h6>
</div>
@endif
<div class="alert d-none">
    <h6 id="message-response"></h6>
</div>
@if(session('cart'))
<table id="cart" class="table table-striped table-condensed mt-3">
    <thead>
        <tr>
            <th style="width:40%" class="h5 py-4">{{ __('Products') }}</th>
            <th style="width:15%" class="h5 py-4">{{ __('Unit price') }}</th>
            <th style="width:8%" class="h5 py-4">{{ __('Quantity') }}</th>
            <th style="width:17%" class="text-center h5 py-4">{{ __('Subtotal') }}</th>
            <th style="width:20%" class="text-center h5 py-4">{{ __('Actions') }}</th>
        </tr>
    </thead>
    <tbody>
@endif
<?php $total = 0 ?>
 @if(session('cart'))
 @foreach(session('cart') as $id => $details)
 <?php $total += $details['price'] * $details['quantity'] ?>
    <tr id="product-show-{{ $id }}">
        <td data-th="Product">
        <form>
            @csrf
            <div class="row">
                <div class="col-sm-3 hidden-xs"><img src="../img/{!!$details['image']!!}" width="100" height="100" class="img-responsive"/></div>
                    <div class="col-sm-9">
                        <h4 class="nomargin">{{ $details['name'] }}</h4>
                    </div>
                </div>
            </div>
            </td>
            <td data-th="Price" class="pl-3" id="price{{$id}}">{{ $details['price'].' RON' }}</td>
            <td data-th="Quantity">
                <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity{{$id}}" min="1" oninput="validity.valid||(value='');"/>
            </td>
            <td data-th="Subtotal" class="text-center" id="subtotal{{$id}}">{{ $details['price'] * $details['quantity'] }} RON</td>
            <td class="actions text-center" data-th="">
            <button class="btn btn-info btn-sm update-cart"  data-id="{{ $id }}"><i class="fa fa-refresh"></i>
                {{ __('Modify') }}
            </button>
            <button class="btn btn-danger btn-sm remove-from-cart"  data-id="{{ $id }}"  id="{{$details['name']}}"><i class="fa fa-trash-o"></i> 
                {{ __('Delete') }}
            </button> 
        </form>  
        </td>
    </tr>
 @endforeach
 </tbody>
 </table>
 
    <div>
        <p class="float-right" style="font-size: 1.4rem;padding-right:20%;"><strong>Total: </strong> <span id="total">{{ $total }} RON</span></p>
    </div>
    <div id="cart-actions">
        <div style="font-size: 1.3rem;" class="text-muted"><i class="fas fa-reply"></i>  <a href="{{ url(app()->getLocale().'/shop') }}" class="text-decoration-none font-weight-bold text-muted">{{ __('Continue shopping') }}</a>
        <a href="{{ url(app()->getLocale().'/cart/success') }}" class="btn btn-danger float-right" id="empty-cart-btn">{{ __('Empty cart') }}</a></div>
    </div>
    <div class="text-center">
        <div class="text-center"><a href="{{ url(app()->getLocale().'/revieworder') }}" class="btn btn-info text-center" id="place-order-btn">{{ __('Place order') }}</a></div>
    </div>


@else
 <h5 class="text-center">{{ __('You have no products in your shopping cart ! Please have a look at our products !') }}</h5>
 <div class="text-center mt-5">
    <a href="{{ url(app()->getLocale().'/shop') }}" class="btn btn-warning">{{ __('Go to shop') }}</a>
 </div>
 <div class="mt-5 pt-5"></div>
 <div class="mt-5 pt-5"></div>
 <div class="mt-5 pt-5"></div>
 @endif
 <div class="mt-5 pt-5"></div>
 <script>
 // Modify cart quantity for a product
  $(".update-cart").click(function (e) {
    e.preventDefault();
    var ele = $(this);
    var id = ele.attr('data-id');
    // get the price from the string
    var price = $('#price'+id).html();
    var str = price;
    var res = str.split(" ");
    // individual quantity
    var quantity = $('.quantity'+id).val();
    
    let currentUrl = "{{ url(app()->getLocale().'/cart') }}";
    
    axios
    .patch("{{ url(app()->getLocale().'/update-cart') }}", {
        data: {
            _token: '{{ csrf_token() }}',
            "id": id, 
            "quantity": quantity
        }
    })
    .then(response => {
        let newSubtotal = parseInt(quantity) * parseInt(res[0]); 
        $('#subtotal'+id).html(newSubtotal+' RON');
        $('#total').load(currentUrl+' #total'); 
        $(".alert").removeClass("d-none");
        $(".alert").addClass("alert-success");
        $("#message-response").html("Produsul a fost actualizat");
    })
    .catch(function (error) {
    	alert('A intervenit o eroare. Va rugam sa incercati din nou');
  })
});

// Remove product from cart
 $(".remove-from-cart").click(function (e) {
    e.preventDefault();
    var ele = $(this);
    var id = $(this).data('id');
    let url = "{{ url(app()->getLocale().'/cart') }}"
    if(confirm("Sunteti sigur ca doriti sa stergeti acest produs?")) {
        axios
        .delete("{{ url(app()->getLocale().'/delete-from-cart') }}", {
            data: {    
                _token:'{{ csrf_token() }}',
                "id": id
                }
        })
        .then(response => {
            $(".alert").addClass("alert-success")  
            $("#message-response").html("Produsul a fost sters")  
            $("#product-show-"+id).remove(); 
            $('#total').load(url+' #total');   
        }) 
        .catch(function (error) {
            alert('A intervenit o eroare. Va rugam sa incercati din nou');
        })   
    }
});
 </script>
</div>
@endsection