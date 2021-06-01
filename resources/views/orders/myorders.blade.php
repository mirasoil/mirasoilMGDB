@extends('layouts.master')
@section('title')
<title>{{ __('My Orders') }} - Mirasoil</title>
@endsection
@section('extra-scripts')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
            <li class="breadcrumb-item active" aria-current="page">{{ __('My Orders') }}</li>
        </ol>
    </nav>
    <div class="container-fluid p-3"> 
        @if(!empty($orders))
        <ul class="order-list">
            @foreach($orders as $order)
            <div class="list-group my-2">
                <a href="{{ url(app()->getLocale().'/myorder/'.$order->id) }}" class="list-group-item list-group-item-action flex-column align-items-start mt-5">
                    <div class="d-flex w-100 justify-content-between">
                        <h3 class="mb-1">{{ __('Order no.') }} {{$order['_id']}}</h3>
                            <small class="h5">
                                @if(!$order->shipped)
                                    {{ __('Not shipped') }}
                                @else
                                    {{ __('Shipped') }}
                                @endif
                            </small>
                    </div>
                    <p class="mt-2"><strong>{{ __('Placed at') }}: </strong> <span class="h5 text-dark"> {{$order->created_at->isoFormat('D MMM YYYY')}}  </span> <strong> {{ __('Total') }}: </strong> <span class="h5 text-dark"> {{$order->billing_total}} RON </span></p>
                    <p>{{ __('Address') }}:  <span class="h5 text-dark"> {{$order->billing_address}} {{$order->billing_city}} - {{$order->billing_county}} </span></p>
                    <p class="h2 mt-3 text-info"><i class="far fa-list-alt"></i> <i class="fas fa-long-arrow-alt-right"></i> <i class="fas fa-mail-bulk"></i> <i class="fas fa-long-arrow-alt-right"></i> <i class="fas fa-shipping-fast"></i> <i class="fas fa-long-arrow-alt-right"></i> <i class="fas fa-map-marked-alt"></i>
                        <button class="btn btn-info float-right" onclick="location.href='/myorder/{{$order->id}}'">Detalii</button>
                    </p>

                </a>
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
@endsection
