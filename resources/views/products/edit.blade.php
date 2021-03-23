@extends('layouts.master')
@section('title')
<title>Modificare produs - Admin</title>
@endsection
@section('content')
<div class="container">
<h1 class="text-center">{{ $product->name }}</h1>
<h3 class="text-center">Modificări</h3>
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
            <form method="POST" action="{{ url(app()->getLocale().'/products/'.$product->slug) }}">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="name"><strong>Nume</strong></label>
                    <input type="text" name="name" class="form-control" value="{{$product->name }}"> 
                </div>
                <div class="form-group">
                    <label for="slug"><strong>Slug</strong></label>
                    <input type="text" name="slug" class="form-control" value="{{$product->slug }}"> 
                </div>
                <div class="form-group">
                    <label for="quantity"><strong>Cantitate</strong></label>
                    <input type="text" name="quantity" class="form-control" value="{{ $product->quantity }}">
                </div>
                <div class="form-group">
                    <label for="price"><strong>Preț</strong></label>
                    <input type="text" name="price" class="form-control" value="{{ $product->price }}" pattern="^\d*(\.\d{0,2})?$">
                </div>
                <div class="form-group">
                    <label for="stock"><strong>Stoc</strong></label>
                    <input type="text" name="stock" class="form-control" value="{{$product->stock }}">
                </div>
                <div class="form-group">
                    <label for="image"><strong>Imagine</strong></label>
                    <input type="text" name="image" class="form-control" value="{{$product->image }}">
                </div>
                <div class="form-group">
                    <label for="description"><strong>Descriere</strong></label>
                    <textarea name="description" class="form-control" rows="3">{{ $product->description }}</textarea> 
                </div>
                <div class="form-group">
                    <label for="properties"><strong>Proprietăți</strong></label>
                    <textarea name="properties" class="form-control" rows="3">{{ $product->properties }}</textarea> 
                </div>
                <div class="form-group">
                    <label for="uses"><strong>Utilizări</strong></label>
                    <textarea name="uses" class="form-control" rows="3">{{ $product->uses }}</textarea> 
                </div>
                <div class="form-group">
                <input type="submit" value="Salvează" class="btn btn-info">
                <a href="{{route('products.index', app()->getLocale()) }}" class="btn btn-danger">Renunță</a>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
<!---populam campurile pe baza routelor
prin product update cand da click pe modificare se transmite id-ul in controller care va insera in baza de date datele
la modificare metoda e PATCH ca se suprapun 2 metode din controller--->