@extends('layouts.master')
@section('title')
<title>{{ __('Product changes') }} - Admin</title>
@endsection
@section('extra-scripts')
<!--Axios-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
@endsection
@section('content')
<div class="container">
<h1 class="text-center">{{ $product->name }}</h1>
<h3 class="text-center">{{ __('Changes') }}</h3>
<div class="panel panel-default" style="padding:50px">
        <div class="panel-body">
            <div class="alert"> 
                <p id="messageResp"></p>
            </div>
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
            <form id="update-data-form">
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
                <button class="btn btn-info" id="updateDetails" data-id="{{ $product->slug }}" type="button">{{ __('Save') }}</button>
                <a href="{{route('products.index', app()->getLocale()) }}" class="btn btn-danger">{{ __('Cancel') }}</a>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).on("click", "#updateDetails", function() { 
        var slug = $('#slugInput').val();
        var filename = $('input[type="file"]').val().split("\\");  //escaping
        var image = filename[filename.length - 1];
        var url = "{{ url(app()->getLocale().'/products/') }}"+'/'+slug;

        formElement = document.getElementById("update-data-form");
        formObject = new FormData(formElement);
        formObject.append("slug", slug);

        dataObject = {};
        formObject.forEach(function(valoare,cheie) {
            dataObject[cheie]=valoare
            })
        dataObject["image"] = image;
        finalData = JSON.stringify(dataObject);

        if(image!="" ) {
            axios
            .patch(url, finalData, {
                headers: {"Content-Type": "application/json"}
                }) 
                .then(response => {
                    if(response.data.statusCode==200){			
                    window.location.href = "{{ route('products.index', app()->getLocale()) }}";     
                    $(".alert").addClass("alert-success"); 
                    $("#messageResp").html("Informațiile au fost actualizate"); 
                    }
                    else if(response.data.statusCode==201){
                        alert("Error occured !");
                    }
                })
            } else {
                alert('Selecteaza imaginea');
            }
        
        });

</script>
@endsection
