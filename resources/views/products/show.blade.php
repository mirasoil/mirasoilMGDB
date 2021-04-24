@extends('layouts.master')
@section('title')
<title>{{ __('Product details') }} - Admin</title>
@endsection
@section('content')
<div class="container">
    <h3>{{ $product->name }} - <span class="text-muted h4">{{ __('Details') }}</span></h3>

    <div class="row mt-5">
        <div class="col">
            <img src="{{'../../img/'.$product->image}}" class="rounded mx-auto d-block shadow-lg" style="width:350px; height:300px;" alt="{{$product->name}}" />
        </div>
        <div class="col mt-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <h5 class="mb-2">{{ __('Price') }}: </h5>
                        <p> {{ $product->price }} RON </p>
                    </div>
                    <div class="form-group">
                        <h5 class="mb-2">{{ __('Stock') }}: </h5>
                        <p> {{ $product->stock }} buc </p>
                    </div>
                    <div class="form-group">
                        <h5 class="mb-2">{{ __('Image') }}: </h5>
                        <p> {{ $product->image }} </p>
                    </div>

                </div>
            </div>
        </div>
        <div class="form-group mt-5">
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
    <div class="float-right m-4">
        <a class="btn btn-primary" href="{{ url(app()->getLocale().'/products/'.$product->slug.'/edit') }}">{{ __('Modify') }}</a>
        <a class="btn btn-info m-3" href="{{ route('products.index', app()->getLocale()) }}">{{ __('Back') }}</a>
    </div>
</div>
<div class="p-5"></div>
@endsection
