@extends('layouts.master')
@section('title')
<title>Modificare comandă - Admin</title>
@endsection
@section('content')
<div class="container">
<h1 class="text-center">{{ __('Order no.') }} {{ $order->id }}</h1>
<h3 class="text-center">{{ __('Changes') }}</h3>
<div class="panel panel-default" style="padding:50px">
        <div class="panel-body">
            <!---exista inregistrari in tabelul task --->
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Error:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                </div>
            @endif
            <!--populez campurile formularului cu datele aferente din tabela tbl_product pe care le pot modifica-->
            {!! Form::model($order, ['method' => 'PATCH','url' => [app()->getLocale().'/order/edit/'.$order->id]]) !!}
        <div class="form-group">
            <label for="billing_fname"><strong>{{ __('First Name') }}</strong></label>
            <input type="text" name="billing_fname" class="form-control" value="{{$order->billing_fname }}"> 
        </div>
        <div class="form-group">
            <label for="billing_lname"><strong>{{ __('Last Name') }}</strong></label>
            <input type="text" name="billing_lname" class="form-control" value="{{$order->billing_lname }}"> 
        </div>
        <div class="form-group">
            <label for="billing_email"><strong>{{ __('Email') }}</strong></label>
            <input type="text" name="billing_email" class="form-control" value="{{ $order->billing_email }}">
        </div>
        <div class="form-group">
            <label for="billing_phone"><strong>{{ __('Phone') }}</strong></label>
            <input type="text" name="billing_phone" class="form-control" value="{{ $order->billing_phone }}">
        </div>
        <div class="form-group">
            <label for="billing_address"><strong>{{ __('Address') }}</strong></label>
            <input type="text" name="billing_address" class="form-control" value="{{$order->billing_address }}">
        </div>
        <div class="form-group">
            <label for="billing_county"><strong>{{ __('County') }}</strong></label>
            <input type="text" name="billing_county" class="form-control" value="{{$order->billing_county }}">
        </div>
        <div class="form-group">
            <label for="billing_city"><strong>{{ __('City') }}</strong></label>
            <input type="text" name="billing_city" class="form-control" value="{{ $order->billing_city }}">
        </div>
        <div class="form-group">
            <label for="billing_zipcode"><strong>{{ __('Zipcode') }}</strong></label>
            <input type="text" name="billing_zipcode" class="form-control" value="{{ $order->billing_zipcode }}">
        </div>
        <div class="form-group">
            <label for="billing_total"><strong>{{ __('Total') }}</strong></label>
            <input type="text" name="billing_total" class="form-control" value="{{ $order->billing_total }}">
        </div>
        <div class="form-group">
            <label for="shipped"><strong>Status</strong></label>
            <input type="number" name="shipped" class="form-control" value="{{ $order->billing_shipped ? 1 : 0 }}"> 
        </div>
        <div class="form-group">
                <input type="submit" value="Salvează" class="btn btn-info">
                <a href="{{url(app()->getLocale().'/orders') }}" class="btn btn-danger">{{ __('Cancel') }}</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
