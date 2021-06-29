@extends('layouts.master')
@section('title')
<title>{{ __('Control Panel') }} - Admin</title>
@endsection
@section('extra-scripts')
<!--Axios-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
@endsection
@section('content')
<div class="container">
<h1 class="text-center">{{ __('Control Panel') }}</h1>
 <div class="panel panel-default">
  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/admin') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Control Panel') }}</li>
        </ol>
    </nav>
    <div class="panel-body">
        <div class="alert d-none" id="message-response"> 
            <h5 id="messageResp"></h5>
        </div>
        <div class="form-group">
            <div class="pull-right">
                <a href="{{ url(app()->getLocale().'/products/create') }}" class="btn btn-primary">{{ __('Create new product') }}</a>
            </div>
        </div>
        <table class="table table-bordered table-stripped">
        <tr>
            <th>{{ __('Slug') }}</th>
            <th>{{ __('Product Name') }}</th>
            <th>{{ __('Quantity') }}</th>
            <th>{{ __('Price') }}</th>
            <th>{{ __('Stock') }}</th>
            <th>{{ __('Image') }}</th>
            <th>{{ __('Description') }}</th>
            <th>{{ __('Properties') }}</th>
            <th>{{ __('Uses') }}</th>
            <th>{{ __('Actions') }}</th>
        </tr>
        @if (count($products) > 0) 
            @foreach ($products as $key => $product)
            <tr id="prod-{{$product->slug}}">
                <td class="d-none">{{ ++$i }}</td>
                <td style="text-align: center; vertical-align: middle;"><strong><i>{{ $product->slug }}</i></strong></td>
                <td style="text-align: center; vertical-align: middle;"><a href="{{ url(app()->getLocale().'/products/'.$product->slug) }}" style="text-decoration:none;color:gray;font-size:18px;"><strong>{{ $product->name }}</strong></a></td>
                <td class="text-center" style="text-align: center; vertical-align: middle;"><p>{{ $product->quantity }}</p></td>
                <td class="text-center" style="text-align: center; vertical-align: middle;"><p>{{ $product->price }}</p></td>
                <td class="text-center" style="text-align: center; vertical-align: middle;"><p>{{ $product->stock }}</p></td>
                <td class="text-center"><a href="{{ url(app()->getLocale().'/products/'.$product->slug) }}"><img src="../img/{{$product->image}}" style="width:100px;" alt="{{ $product->name }}"/></a></td>
                <td><a class="text-decoration-none" href="{{ url(app()->getLocale().'/products/'.$product->slug) }}"><p>{!! Str::limit($product->description, 50) !!}</p></a></td>
                <td><a class="text-decoration-none" href="{{ url(app()->getLocale().'/products/'.$product->slug) }}"><p>{!! Str::limit($product->properties, 50) !!}</p></a></td>
                <td><a class="text-decoration-none" href="{{ url(app()->getLocale().'/products/'.$product->slug) }}"><p>{!! Str::limit($product->uses, 50) !!}</p></a></td> 
                <td class="text-center">
                    <a class="btn btn-info mt-3" href="{{ url(app()->getLocale().'/products/'.$product->slug.'/edit') }}">{{ __('Modify') }}</a><br>
                    <button class="btn btn-danger mt-3" id="{{ $product->slug }}" onclick="deleteProduct(this.id)">{{ __('Delete') }}</button>
                </td>
            </tr>
             @endforeach
        @else
            <tr>
                <td colspan="4"> {{ __('There are no products in the database!') }}</td>
            </tr>
        @endif
        </table>
        <div class="float-right mt-3">
            <a class="btn btn-lg btn-info my-4" href="{{ url(app()->getLocale().'/admin') }}">{{ __('Back') }}</a>
        </div>
        <!-- Page numbering -->
        {{$products->render()}} 
    </div>
 </div>
 </div>
 <div class="py-5"></div>
 <script>
//Delete button
function deleteProduct(slug){
    if(confirm('Sunteti sigur ca doriti stergerea permanenta a produsului ?')){
        axios
        .delete("{{ url(app()->getLocale().'/products/') }}"+'/'+slug, {
            data:{
                _token:'{{ csrf_token() }}',
                'slug': slug
            }
        })
        .then(res => {
            if (res.status === 200) {
                $("#prod-"+slug).remove();
                $('.alert').removeClass('d-none');
                $('.alert').addClass(' alert-success');
                $('#messageResp').html('Produs sters cu succes!');
                setTimeout(function(){$('#message-response').fadeOut();}, 3000);
            } else {
                alert('A intervenit o eroare');
            }
        })
    }
}
 </script>
@endsection