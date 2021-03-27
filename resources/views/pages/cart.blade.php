@extends('layouts.master')
@section('title')
<title>{{ __('Cart') }} - Mirasoil</title>
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
            @method('PATCH')
        <div class="row">
            <div class="col-sm-3 hidden-xs"><img src="../img/{!!$details['image']!!}" width="100" height="100" class="img-responsive"/></div>
                <div class="col-sm-9">
                    <h4 class="nomargin">{{ $details['name'] }}</h4>
                </div>
            </div>
        </td>
        <td data-th="Price" id="price{{$id}}">{{ $details['price'].' Lei' }}</td>
        <td data-th="Quantity">
            <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity{{$id}}"/>
        </td>
        <td data-th="Subtotal" class="text-center" id="subtotal{{$id}}">{{ $details['price'] * $details['quantity'] }} Lei</td>
        <td class="actions text-center" data-th="">
        
            <button class="btn btn-info btn-sm update-cart"  data-id="{{ $id }}" style="margin: 10px;" ><i class="fa fa-refresh"></i> {{ __('Modify') }}</button>
            <button class="btn btn-danger btn-sm remove-from-cart"  data-id="{{ $id }}" style="margin: 10px;" id="{{$details['name']}}"><i class="fa fa-trash-o"></i>{{ __('Delete') }}</button> 
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
        <td><a href="{{ url(app()->getLocale().'/shop') }}" class="btn btn-warning">{{ __('Continue shopping') }}</a></td>
        <td colspan="3" class="hidden-xs"></td>
        <td class="text-center"><a href="{{ url(app()->getLocale().'/cart/success') }}" class="btn btn-warning text-center">{{ __('Empty cart') }}</a></td>
    </tr>
    <tr>
        <td colspan="4" class="hidden-xs"></td>
        <td class="text-center"><a href="{{ url(app()->getLocale().'/revieworder') }}" class="btn btn-warning">{{ __('Place order') }}</a></td>
</tfoot>
</table>
@else
 <h4 class="text-center">{{ __('Your shopping cart is empty ! Please have a look at our products !') }}</h4>
 <div class="text-center mt-5">
    <a href="{{ url(app()->getLocale().'/shop') }}" class="btn btn-warning">{{ __('Go to shop') }}</a>
 </div>
 @endif
 <script>
 $(".update-cart").click(function (e) {
        e.preventDefault();
        var ele = $(this);
        var id = ele.attr('data-id');
        //accesez pretul din string
        var price = $('#price'+id).html();
        var str = price;
        var res = str.split(" ");
        //cantitatea individuala a fiearui produs
        var quantity = $('.quantity'+id).val();
        
        let currentUrl = "{{ url(app()->getLocale().'/cart') }}";

        $.ajax({
            url: "{{ url(app()->getLocale().'/update-cart') }}",
            method: "PATCH",
            data: {
                _token: '{{ csrf_token() }}',
                id: id, 
                quantity: quantity
            }, 
            success: function(response) {
                let newSubtotal = parseInt(quantity) * parseInt(res[0]); 
                $('#subtotal'+id).html(newSubtotal+' Lei');
                $('#total').load(currentUrl+' #total'); 
                $(".alert").addClass("alert-success");
                $("#message-response").html("Produsul a fost actualizat");
                
                console.log(newSubtotal, quantity, res[0])
            }
        
    });
 });
 $(".remove-from-cart").click(function (e) {
        e.preventDefault();
        var ele = $(this);
        var id = $(this).data('id');
        let url = "{{ url(app()->getLocale().'/cart') }}"
        if(confirm("Sunteti sigur ca doriti sa stergeti acest produs?")) {
            $.ajax({
                type: 'DELETE',
                url: "{{ url(app()->getLocale().'/delete-from-cart') }}",
                data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                success: function (response) {
                    $(".alert").addClass("alert-success")  //stilizare
                    $("#message-response").html("Produsul a fost sters")  //continutul mesajului
                    $("#product-show-"+id).remove(); //vreau doar sa dispara paragraful cu produsul sters, fara reload
                    $('#total').load(url+' #total');    //reincarca doar sectiunea #total din pagina
            }
        });
    }
 });
 </script>
</div>
@endsection