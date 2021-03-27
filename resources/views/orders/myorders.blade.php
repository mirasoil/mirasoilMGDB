@extends('layouts.master')
@section('title')
<title>{{ __('My Orders') }} - Mirasoil</title>
@endsection
@section('extra-scripts')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="container">
    <div class="container-fluid p-5" style="background-color:#e4f1f9;">
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
        <!-- <small>
            <a href="/myorder/{{$order->id}}"><button class="btn btn-info float-right mt-3">Detalii</button></a>
        </small> -->
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
