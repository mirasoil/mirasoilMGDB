@extends('layouts.master')
@section('title')
<title>{{ __('Product details') }} - Admin</title>
@endsection
@section('content')
<div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/admin') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/products') }}">{{ __('Control Panel') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Details') }}</li>
            </ol>
        </nav>
    <h2 class="text-center">{{ $product->name }} - <span class="text-muted h3">{{ __('Product sheet') }} </span></h2>
    <div class="row mt-5">
        <div class="col">
            <img src="{{'../../img/'.$product->image}}" class="rounded mx-auto d-block shadow-lg" style="width:350px; height:500px;" alt="{{$product->name}}" />
            <p class="mt-4 text-center">{{ $product->image }}</p>
            <h5 class="my-3 text-center">{{ __('Price') }}: <span class="text-muted">{{ $product->price }} RON</span></h5>
            <h5 class="my-3 text-center">{{ __('Stock') }}:  <span class="text-muted">{{ $product->stock }} buc</span></h5>
        </div>
        <div class="col mt-2">
            
            <div class="form-group">
                <h5 class="mb-2">{{ __('Description') }}: </h5>
                <p> {!! $product->description !!} </p>
            </div>
            <div class="form-group">
                <h5 class="mb-2">{{ __('Properties') }}: </h5>
                <p> {!! $product->properties !!} </p>
            </div>
            <div class="form-group">
                <h5 class="mb-2">{{ __('Uses') }}: </h5>
                <p> {!! $product->uses !!} </p>
            </div>
        </div>
    </div>
    <div class="float-right m-4">
        <a class="btn btn-primary" href="{{ url(app()->getLocale().'/products/'.$product->slug.'/edit') }}">{{ __('Modify') }}</a>
        <a class="btn btn-info m-3" href="{{ route('products.index', app()->getLocale()) }}">{{ __('Back') }}</a>
    </div>
</div>
<div class="p-5"></div>
@endsection
