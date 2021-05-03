@extends('layouts.master')
@section('title')
<title>{{ __('My Orders') }} - Mirasoil</title>
@endsection
@section('extra-scripts')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
    <div class="container-fluid p-3" style="background-color:#e4f1f9;">
        <h3 class="text-center">{{ __('My Orders') }}</h3>
        <ul class="order-list">
        @foreach($orders as $order)
        <div class="list-group my-2">
    <a href="{{ url(app()->getLocale().'/myorder/'.$order->id) }}" class="list-group-item list-group-item-action flex-column align-items-start bg-info text-white mt-5">
        <div class="d-flex w-100 justify-content-between">
        <h3 class="mb-1">{{ __('Order no.') }} {{$order['_id']}}</h3>
        <small>
            @if(!$order->shipped)
                {{ __('Not shipped') }}
            @else
                {{ __('Shipped.') }}
            @endif
        </small>
        </div>
        <p class="my-1 text-white"><strong><small>{{ __('Placed at') }}: </small></strong> {{$order->created_at->isoFormat('D MMM YYYY')}}   <strong><small>{{ __('Total') }}:</small></strong> {{$order->billing_total}} RON</p>
        <small>{{ __('Address') }}:</small>  {{$order->billing_address}} {{$order->billing_city}} - {{$order->billing_county}}
        
            <button class="btn btn-light float-right mt-3" onclick="location.href='/myorder/{{$order->id}}'">Detalii</button>
    </a>

    <br>
    </div>
    @endforeach
        </ul>
    </div>
</div>
@for($i=0;$i<=5;$i++)
 <br>
@endfor
@endsection
