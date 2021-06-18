@extends('layouts.master')
@section('title')
<title>{{ ('Adding product') }} - Admin</title>
@endsection
@section('content')
<div class="container">
      <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/admin') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/products') }}">{{ __('Control Panel') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Add new product') }}</li>
            </ol>
        </nav>
    <h1 class="text-center">{{ __('Add new product') }}</h1>
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
            
            <form id="form">
            @csrf           
                <div class="form-group">
                    <label for="name">{{ __('Product Name') }}</label>
                    <hr>
                    <input type="text" name="name" class="form-control"  id="name">
                </div>
                <div class="form-group">
                    <label for="slug">{{ __('Slug') }}</label>
                    <hr>
                    <input type="text" name="slug" class="form-control" id="slug" onblur="checkSlug()">
                    <span class="invalid-feedback" role="alert">
                        <strong id="slug-error"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label for="name">{{ __('Quantity') }}</label>
                    <hr>
                    <input type="number" name="quantity" min="0" class="form-control" id="quantity">
                </div>
                <div class="form-group">
                    <label for="price">{{ __('Price') }}</label>
                    <hr>
                    <input type="number" name="price" min="0" step=".01" class="form-control" id="price">
                </div>
                <div class="form-group">
                    <label for="stock">{{ __('Stock') }}</label>
                    <hr>
                    <input type="number" name="stock" min="0" class="form-control" id="stock">
                </div>
                <div class="form-group">
                    <label for="image">{{ __('Image') }}</label>
                    <hr>
                    <input type="file" name="image" class="p-0" id="image">
                </div>
                <div class="form-group">
                    <label for="description">{{ __('Description') }}</label>
                    <hr>
                    <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="properties">{{ __('Properties') }}</label>
                    <hr>
                    <textarea name="properties" class="form-control" id="properties" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="uses">{{ __('Uses') }}</label>
                    <hr>
                    <textarea name="uses" class="form-control" id="uses" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-info" id="createProduct" type="button">{{ __('Save product') }}</button>
                    <a href="{{ route('products.index', app()->getLocale()) }}" class="btn btn-danger">{{ __('Cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
//Create product
$(document).on("click", "#createProduct", function(e) { 
    e.preventDefault();
    var url = "{{ route('products.store', app()->getLocale()) }}";
    var name = $('#name').val();
    var slug = $('#slug').val();
    var quantity = $('#quantity').val();
    var price = $('#price').val();
    var stock = $('#stock').val();
    //selecting only last part of the string as image path (C:/fakepath/name.jpg)
    var filename = $('input[type="file"]').val().split("\\");  //escaping
    var image = filename[filename.length - 1];
    var description = $('#description').val();
    var properties = $('#properties').val();
    var uses = $('#uses').val();

    axios
    .post(url, {
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
    }) 
    .then(response => {
        if(response.data.statusCode == 200){			
            window.location.href = "{{ route('products.index', app()->getLocale()) }}"; 
            $(".alert").addClass("alert-success"); 
            $("#messageResp").html("Produsul a fost adaugat!");   
            }
            else if(response.data.statusCode == 201){
            alert('Acest slug exista deja in baza de date !');
            } 
    })
});

// Verify if there is a product in our database with the same slug
function checkSlug() {
    // e.preventDefault();
    var slug = $('#slug').val();
    let url = "{{ route('slug.check', app()->getLocale()) }}"
    if(slug != "") {
        axios({
            method: 'post',
            url: url,
            data: {
                _token: "{{ csrf_token() }}",
                slug: slug
            }
        })
        .then((response) => {	
            var input = document.getElementById('slug');

            if(response.data.statusCode == 200){
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
            }
            else if(response.data.statusCode == 201){
                input.classList.add('is-invalid');
                $('#slug-error').html('Acest slug exista deja in baza de date !');
            }
        })
        .catch(function (error) {
            var input = document.getElementById('slug');
            input.classList.add('is-invalid');
            $('#slug-error').html('Acest slug exista deja in baza de date !');
        })
    }
}
</script>
@endsection