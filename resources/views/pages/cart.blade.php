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
    <div class="py-2 text-center">
        <h2>{{ __('My Cart') }}</h2>
        <p class="lead"></p>
    </div>
 @if (\Session::has('cart-success'))
<div class="alert alert-success">
<p id="message-response">{{ \Session::get('cart-success') }}</p>
</div><br />
@endif
@if (\Session::has('cart-failure'))
<div class="alert alert-danger">
<p id="message-response">{{ \Session::get('cart-failure') }}</p>
</div><br />
@endif
<div class="alert">
<p id="message-response"></p>
</div><br />
@if(session('cart'))
<table id="cart" class="table table-hover table-condensed mt-3">
    <thead>
        <tr>
            <th style="width:45%">{{ __('Products') }}</th>
            <th style="width:10%">{{ __('Unit price') }}</th>
            <th style="width:8%">{{ __('Quantity') }}</th>
            <th style="width:17%" class="text-center">{{ __('Subtotal') }}</th>
            <th style="width:20%" class="text-center">{{ __('Actions') }}</th>
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
            <td data-th="Price" id="price{{$id}}">{{ $details['price'].' Lei' }}</td>
            <td data-th="Quantity">
                <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity{{$id}}" min="1" oninput="validity.valid||(value='');"/>
            </td>
            <td data-th="Subtotal" class="text-center" id="subtotal{{$id}}">{{ $details['price'] * $details['quantity'] }} Lei</td>
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
 <tfoot>
    <tr class="visible-sm">
        <td colspan="3" class="hidden-xs"></td>
        <td class="text-center" style="font-size: 1.1rem;"><strong>Total: </strong> <p id="total">{{ $total }}Lei</p></td>
        <td></td>
    </tr>
    <tr>
        <td><a href="{{ url(app()->getLocale().'/shop') }}" class="btn btn-info">{{ __('Continue shopping') }}</a></td>
        <td colspan="3" class="hidden-xs"></td>
        <td class="text-center"><a href="{{ url(app()->getLocale().'/cart/success') }}" class="btn btn-danger text-center">{{ __('Empty cart') }}</a></td>
    </tr>
    <tr>
        <td colspan="4" class="hidden-xs"></td>
        <td class="text-center"><a href="{{ url(app()->getLocale().'/revieworder') }}" class="btn btn-success">{{ __('Place order') }}</a></td>
</tfoot>
</table>
@else
 <h4 class="text-center">{{ __('Your shopping cart is empty ! Please have a look at our products !') }}</h4>
 <div class="text-center mt-5">
    <a href="{{ url(app()->getLocale().'/shop') }}" class="btn btn-warning">{{ __('Go to shop') }}</a>
 </div>
 @endif
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
        $('#subtotal'+id).html(newSubtotal+' Lei');
        $('#total').load(currentUrl+' #total'); 
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