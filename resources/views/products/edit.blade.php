@extends('layouts.master')
@section('title')
<title>{{ __('Product changes') }} - Admin</title>
@endsection
@section('content')
<div class="container">
<h1 class="text-center">{{ $product->name }}</h1>
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
            <form>
                @csrf
                <div class="form-group">
                    <label for="name"><strong>{{ __('Product Name') }}</strong></label>
                    <input type="text" name="name" class="form-control" id="nameInput" value="{{ $product->name }}"> 
                </div>
                <div class="form-group">
                    <label for="slug"><strong>{{ __('Slug') }}</strong></label>
                    <input type="text" name="slug" class="form-control" id="slugInput" value="{{ $product->slug }}" disabled> 
                </div>
                <div class="form-group">
                    <label for="quantity"><strong>{{ __('Quantity') }}</strong></label>
                    <input type="text" name="quantity" class="form-control" id="qtyInput" value="{{ $product->quantity }}">
                </div>
                <div class="form-group">
                    <label for="price"><strong>{{ __('Price') }}</strong></label>
                    <input type="text" name="price" class="form-control" id="priceInput" value="{{ $product->price }}" pattern="^\d*(\.\d{0,2})?$">
                </div>
                <div class="form-group">
                    <label for="stock"><strong>{{ __('Stock') }}</strong></label>
                    <input type="text" name="stock" class="form-control" id="stockInput" value="{{ $product->stock }}">
                </div>
                <div class="form-group">
                    <label for="image"><strong>{{ __('Image') }}</strong></label>
                    <input type="text" class="form-control" value="{{ $product->image }}"><input type="file" name="image" class="p-0" id="imageInput">
                </div>
                <div class="form-group">
                    <label for="description"><strong>{{ __('Description') }}</strong></label>
                    <textarea name="description" class="form-control" id="descInput" rows="3">{{ $product->description }}</textarea> 
                </div>
                <div class="form-group">
                    <label for="properties"><strong>{{ __('Properties') }}</strong></label>
                    <textarea name="properties" class="form-control" id="propInput" rows="3">{{ $product->properties }}</textarea> 
                </div>
                <div class="form-group">
                    <label for="uses"><strong>{{ __('Uses') }}</strong></label>
                    <textarea name="uses" class="form-control" id="usesInput" rows="3">{{ $product->uses }}</textarea> 
                </div>
                <div class="form-group">
                <button class="btn btn-info" id="updateDetails" data-id="{{ $product->slug }}">{{ __('Save') }}</button>
                <a href="{{route('products.index', app()->getLocale()) }}" class="btn btn-danger">{{ __('Cancel') }}</a>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
   
   $('#updateDetails').on('click', function() {
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
             url: "{{ url(app()->getLocale().'/products/') }}"+'/'+slug,
             type: "PATCH",
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
                   window.location.href = "{{ route('products.index', app()->getLocale()) }}";     //redirected back with success message
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
