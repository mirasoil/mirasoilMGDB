@extends('layouts.master')
@section('title')
<title>Detalii produs - Admin</title>
@endsection
@section('content')
<div class="container">
<h3 class="text-center">{{ $product->name }}</h3>
<h5 class="text-center">Detalii</h5>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group">
                <img src="{{'../../img/'.$product->image}}" class="shadow p-3 mb-5 bg-white rounded" style="width:400px; height:300px;" alt="{{$product->name}}"/> <!--- preluam din products numele --->
            </div>
            <div class="form-group">
                <strong>Preț: </strong><p> {{ $product->price }} RON </p>
            </div>
            <div class="form-group">
                <strong>Stoc: </strong><p> {{ $product->stock }} buc </p>
            </div>
            <div class="form-group">
                <strong>Imagine: </strong><p> {{ $product->image }} </p>
            </div>
            <div class="form-group">
                <strong>Descriere: </strong><p> {!! $product->description !!} </p>
            </div>
            <div class="form-group">
                <strong>Proprietăți: </strong><p> {!! $product->properties !!} </p>
            </div>
            <div class="form-group">
                <strong>Utilizări: </strong><p> {!! $product->uses !!} </p>
            </div>
            <div class="float-right m-4">
                <a class="btn btn-info m-4" href="{{ route('products.index', app()->getLocale()) }}">Înapoi</a>
            </div>
        </div>
    </div>
</div>
<div class="p-5"></div>
@endsection
<!--- afiseaza datele pe ecran cum sunt in baza de date cu id-ul curent --->