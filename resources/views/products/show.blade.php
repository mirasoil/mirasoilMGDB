@extends('layouts.master')
@section('title')
<title>{{ __('Product details') }} - Admin</title>
@endsection
@section('content')
<div class="container">
<h3 class="text-center">{{ $product->name }}</h3>
<h5 class="text-center">{{ __('Details') }}</h5>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group">
                <img src="{{'../../img/'.$product->image}}" class="shadow p-3 mb-5 bg-white rounded" style="width:400px; height:300px;" alt="{{$product->name}}"/> <!--- preluam din products numele --->
            </div>
            <div class="form-group">
                <strong>{{ __('Price') }}: </strong><p> {{ $product->price }} RON </p>
            </div>
            <div class="form-group">
                <strong>{{ __('Stock') }}: </strong><p> {{ $product->stock }} buc </p>
            </div>
            <div class="form-group">
                <strong>{{ __('Image') }}: </strong><p> {{ $product->image }} </p>
            </div>
            <div class="form-group">
                <strong>{{ __('Description') }}: </strong><p> {!! $product->description !!} </p>
            </div>
            <div class="form-group">
                <strong>{{ __('Properties') }}: </strong><p> {!! $product->properties !!} </p>
            </div>
            <div class="form-group">
                <strong>{{ __('Uses') }}: </strong><p> {!! $product->uses !!} </p>
            </div>
            <div class="float-right m-4">
                <a class="btn btn-info m-4" href="{{ route('products.index', app()->getLocale()) }}">{{ __('Back') }}</a>
            </div>
        </div>
    </div>
</div>
<div class="p-5"></div>
@endsection
<!--- afiseaza datele pe ecran cum sunt in baza de date cu id-ul curent --->