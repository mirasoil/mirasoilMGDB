@extends('layouts.master')
@section('title')
<title>{{ __('My Orders') }} - Mirasoil</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('extra-scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@endsection
@section('content')
<div class="container">
    <nav aria-label="breadcrumb" class="main-breadcrumb mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/user') }}">{{ __('My Account') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('My Orders') }}</li>
        </ol>
    </nav>
    <div class="container-fluid px-3"> 
    <div class="alert">
        <h5 class="text-center order-success"></h5>
    </div>
        @if(!empty($orders))
        <ul class="order-list">
            @foreach($orders as $order)
            <div class="list-group my-2" id="order-{{$order->id}}">
                <div class="list-group-item list-group-item-action flex-column align-items-start mt-5">
                    <a href="{{ url(app()->getLocale().'/myorder/'.$order->id) }}" class="text-decoration-none text-dark">
                        <div class="d-flex w-100 justify-content-between">
                            <h3 class="mb-1">{{ __('Order no.') }} <?php echo substr($order['_id'], -6) ?></h3>
                                <small class="h5">
                                    @if(!$order->shipped)
                                        {{ __('Not shipped') }} <i class="fas fa-spinner"></i>
                                    @else
                                        {{ __('Shipped') }} <i class="fas fa-check-circle"></i>
                                    @endif
                                </small>
                        </div>
                        <p class="mt-2"><strong>{{ __('Placed at') }}: </strong> <span class="h5 text-dark"> {{$order->created_at->isoFormat('D MMM YYYY')}}  </span> <strong> {{ __('Total') }}: </strong> <span class="h5 text-dark"> {{$order->billing_total}} RON </span></p>
                        <p>{{ __('Address') }}:  <span class="h5 text-dark"> {{$order->billing_address}} {{$order->billing_city}} - {{$order->billing_county}} </span></p>
                        </a>
                        <p class="h2 mt-3 text-info"><i class="far fa-list-alt"></i> <i class="fas fa-long-arrow-alt-right"></i> <i class="fas fa-mail-bulk"></i> <i class="fas fa-long-arrow-alt-right"></i> <i class="fas fa-shipping-fast"></i> <i class="fas fa-long-arrow-alt-right"></i> <i class="fas fa-map-marked-alt"></i>
                            <button class="btn btn-info float-right" onclick="location.href='/ro/myorder/{{$order->id}}'">{{ __('Details') }}</button>
                            @if(!$order->shipped) <!--if order is not shipped yet, user can cancel-->
                                <button class="btn btn-danger float-right mr-3" id="{{$order->id}}" onclick="cancelOrder(this.id)">{{ __('Cancel order') }}</button>
                            @endif
                        </p>
                </div>
                
            </div>
            @endforeach
        </ul>
        @else
        <h5 class="text-center mt-5">{{ __('You have no orders registered yet.') }} </h5>
        @endif
    </div>
</div>
@for($i=0;$i<=5;$i++)
 <br>
@endfor
<script>
// Cancel order if it was not shipped yet
function cancelOrder(id){
    let url = "{{ url(app()->getLocale().'/myorders/') }}"+"/"+id;

    if(confirm("Aceasta actiune este definitiva. Sunteti sigur ca doriti sa anulati comanda?")) {
        axios
        .delete(url, {
            data: {    
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: id
            }
        })
        .then(response => {
            $(".alert").addClass("alert-success")  
            $(".order-success").html("Comanda a fost anulată!")  
            $("#order-"+id).remove();   
        }) 
        .catch(function (error) {
            alert('A intervenit o eroare. Va rugam sa incercati din nou');
        })   
    }    
}

</script>
@endsection
