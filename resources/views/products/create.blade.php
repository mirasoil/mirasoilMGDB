@extends('layouts.master')
@section('title')
<title>{{ ('Adding product') }} - Admin</title>
@endsection
@section('content')
<div class="container">
    <h1 class="text-center">{{ ('Add product') }}</h1>
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
            
            <form>
            @csrf           
                <div class="form-group">
                    <label for="name">{{ __('Product Name') }}</label>
                    <hr>
                    <input type="text" name="name" class="form-control"  id="nameInput" value="{{old('name') }}">
                </div>
                <div class="form-group">
                    <label for="slug">{{ __('Slug') }}</label>
                    <hr>
                    <input type="text" name="slug" class="form-control" id="slugInput" value="{{old('slug') }}">
                </div>
                <div class="form-group">
                    <label for="name">{{ __('Quantity') }}</label>
                    <hr>
                    <input type="number" name="quantity" min="0" class="form-control" id="qtyInput" value="{{old('quantity') }}">
                </div>
                <div class="form-group">
                    <label for="price">{{ __('Price') }}</label>
                    <hr>
                    <input type="number" name="price" min="0" step=".01" class="form-control" id="priceInput" value="{{old('price') }}">
                </div>
                <div class="form-group">
                    <label for="stock">{{ __('Stock') }}</label>
                    <hr>
                    <input type="number" name="stock" min="0" class="form-control" id="stockInput" value="{{old('stock') }}">
                </div>
                <div class="form-group">
                    <label for="image">{{ __('Image') }}</label>
                    <hr>
                    <input type="file" name="image" class="p-0" id="imageInput">
                </div>
                <div class="form-group">
                    <label for="description">{{ __('Description') }}</label>
                    <hr>
                    <textarea name="description" class="form-control" id="descInput" rows="3">{!! old('description') !!}</textarea>
                </div>
                <div class="form-group">
                    <label for="properties">{{ __('Properties') }}</label>
                    <hr>
                    <textarea name="properties" class="form-control" id="propInput" rows="3">{!! old('properties') !!}</textarea>
                </div>
                <div class="form-group">
                    <label for="uses">{{ __('Uses') }}</label>
                    <hr>
                    <textarea name="uses" class="form-control" id="usesInput" rows="3">{!! old('uses') !!}</textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-info" id="createProduct">{{ __('Save product') }}</button>
                    <a href="{{ route('products.index', app()->getLocale()) }}" class="btn btn-danger">{{ __('Cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
//Create product
$(document).ready(function() {
   
   $('#createProduct').on('click', function() {
     var name = $('#nameInput').val();
     var slug = $('#slugInput').val();
     var quantity = $('#qtyInput').val();
     var price = $('#priceInput').val();
     var stock = $('#stockInput').val();
     //selecting only last part of the string as image path (C:/fakepath/name.jpg)
     var filename = $('input[type="file"]').val().split("\\");  //escaping
     var image = filename[filename.length - 1];
     var description = $('#descInput').val();
     var properties = $('#propInput').val();
     var uses = $('#usesInput').val();

     if(name!="" && slug!="" && quantity!="" && price!="" && stock!="" && image!="" && description!="" && properties!="" && uses!=""){
         $.ajax({
             url: "{{ route('products.store', app()->getLocale()) }}",
             type: "POST",
             data: {
                 _token: '{{ csrf_token() }}',
                 name: name,
                 slug: slug,
                 quantity: quantity,
                 price: price,
                 stock: stock,
                 image: image,
                 description: description,
                 properties: properties,
                 uses: uses
             },
             cache: false,
             success: function(dataResult){
                //  console.log(dataResult);
                 var dataResult = JSON.parse(dataResult);
                 if(dataResult.statusCode==200){			
                   window.location.href = "{{ route('products.index', app()->getLocale(), [ session(['success' => 'Produs adaugat cu succes!'])]) }}";     //redirected back with success message
                   //session needs to be flushed after reload or specified amount of time
                 }
                 else if(dataResult.statusCode==201){
                    alert("Error occured !");
                 }
                 
             }
         });
     }
     else{
         alert('Please fill all the field !');
     }
 });
});

</script>
@endsection