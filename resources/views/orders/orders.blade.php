@extends('layouts.master')
@section('title')
<title>{{ __('Orders Editor') }} - Admin</title>
@endsection
@section('extra-scripts')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="container">
<h3 class="text-center">{{ __('Orders Editor') }}</h3>
    <div class="panel panel-default" style="padding:50px">
        <div class="panel-body">
            <!---Capul de tabel care ramane mereu la fel, nu depinde de foreach--->
            <table class="table table-bordered table-stripped">
            <tr>
                <th>{{ __('Order ID') }}</th>
                <th>{{ __('User ID') }}</th>
                <th>{{ __('Date') }}</th>
                <th>{{ __('Total') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
            @foreach($orders as $order)
            <tr>
                <div class="d-none">{{ ++$i }}</div>
                <td>
                    <a href="{{ url(app()->getLocale().'/order/'.$order['id']) }}">{{ $order['id'] }}</a>
                </td>
                <td>
                    <a href="{{ url(app()->getLocale().'/user/'.$order['user_id']) }}">{{ $order['user_id'] }}</a>
                </td>
                <td>{{$order->created_at->isoFormat('D MMM YYYY')}}</td>
                <td>{{ $order['billing_total'] }} RON</td>
                <td>@if(!$order->shipped)
                        {{ __('Not shipped') }}
                    @else
                        {{ __('Shipped') }}
                    @endif
                </td>
                <td> 
                <a class="btn btn-success m-2" href="{{ url(app()->getLocale().'/order',$order->id) }}">{{ __('Details') }}</a><br>
                    <a class="btn btn-primary m-2" href="{{ url(app()->getLocale().'/order/edit',$order->id) }}">{{ __('Modify') }}</a><br>
                    {{ Form::open(['method' => 'DELETE','url' => [app()->getLocale().'/order/'.$order['id']],'style'=>'display:inline']) }}   <!--se activeaza metoda destroy din ProductController-->
                    {{ Form::submit(__('Delete'), ['class' => 'btn btn-danger m-2']) }} <!---metoda delete din ProductController functia destroy---->
                    {{ Form::close() }}
                </td>
            </tr>
            @endforeach
            </table>
            <div class="float-right m-4">
                <a class="btn btn-info m-4" href="{{ url(app()->getLocale().'/admin') }}">{{ __('Back') }}</a>
            </div>
            <div class="float-right">{{$orders->render()}}</div><br>
        </div>
    </div>
 </div>
 @for($i=0;$i<=7;$i++)
 <br>
 @endfor
@endsection