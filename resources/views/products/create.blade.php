@extends('layouts.master')
@section('title')
<title>Adăugare produs - Admin</title>
@endsection
@section('content')
<div class="container">
    <h1 class="text-center">Adaugă un produs nou</h1>
    <div class="panel panel-default p-5">
        <div class="panel-body">
            @if (count($errors) > 0)
            <!---In cazul in care exista erori le vom afisa--->
            <div class="alert alert-danger">
                <strong>Errors:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <!---Vom trimite prin post toate datele introduse in formular, apeland functia store din ProductController --->
            
            <form method="POST" action="{{ route('products.store', app()->getLocale(),['id' => $id=Auth::user()->id]) }}">
                            @csrf
                            
                <div class="form-group">
                    <label for="name">Nume</label>
                    <hr>
                    <input type="text" name="name" class="form-control" value="{{old('name') }}">
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <hr>
                    <input type="text" name="slug" class="form-control" value="{{old('slug') }}">
                </div>
                <div class="form-group">
                    <label for="name">Cantitate</label>
                    <hr>
                    <input type="number" name="quantity" min="0" class="form-control" value="{{old('quantity') }}">
                </div>
                <div class="form-group">
                    <label for="price">Preț</label>
                    <hr>
                    <input type="number" name="price" min="0" step=".01" class="form-control" value="{{old('price') }}">
                </div>
                <div class="form-group">
                    <label for="stock">Stoc</label>
                    <hr>
                    <input type="number" name="stock" min="0" class="form-control" value="{{old('stock') }}">
                </div>
                <div class="form-group">
                    <label for="image">Imagine</label>
                    <hr>
                    <input type="file" name="image" class="p-0">
                </div>
                <div class="form-group">
                    <label for="description">Descriere</label>
                    <hr>
                    <textarea name="description" class="form-control" rows="3">{!! old('description') !!}</textarea>
                </div>
                <div class="form-group">
                    <label for="properties">Proprietăți</label>
                    <hr>
                    <textarea name="properties" class="form-control" rows="3">{!! old('properties') !!}</textarea>
                </div>
                <div class="form-group">
                    <label for="uses">Utilizări</label>
                    <hr>
                    <textarea name="uses" class="form-control" rows="3">{!! old('uses') !!}</textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="Adaugă produsul" class="btn btn-info">
                    <a href="{{ route('products.index', app()->getLocale()) }}" class="btn btn-danger">Renunță</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection