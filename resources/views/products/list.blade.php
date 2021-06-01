@extends('layouts.master')
@section('title')
<title>{{ __('Control Panel') }} - Admin</title>
@endsection
@section('extra-scripts')
<!--Axios-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
@endsection
@section('content')
<h1 class="text-center">{{ __('Control Panel') }}</h1>
 <div class="panel panel-default" style="padding:50px">
    <div class="panel-body">
        <div class="alert"> 
            <p id="messageResp"></p>
        </div>
        <div class="form-group">
            <div class="pull-right">
                <a href="{{ url(app()->getLocale().'/products/create') }}" class="btn btn-info">{{ __('Create new product') }}</a>
            </div>
        </div>
        <table class="table table-bordered table-stripped">
        <tr>
            <th width="50">{{ __('Slug') }}</th>
            <th width="200">{{ __('Product Name') }}</th>
            <th width="80">{{ __('Quantity') }}</th>
            <th width="80">{{ __('Price') }}</th>
            <th width="80">{{ __('Stock') }}</th>
            <th>{{ __('Image') }}</th>
            <th width="250">{{ __('Description') }}</th>
            <th width="250">{{ __('Properties') }}</th>
            <th width="250">{{ __('Uses') }}</th>
            <th width="100">{{ __('Actions') }}</th>
        </tr>
        @if (count($products) > 0) 
            @foreach ($products as $key => $product)
            <tr id="prod-{{$product->slug}}">
                <td class="d-none">{{ ++$i }}</td>
                <td><strong><i>{{ $product->slug }}</i></strong></td>
                <td><a href="{{ url(app()->getLocale().'/products/'.$product->slug) }}" style="text-decoration:none;color:gray;font-size:18px;"><strong>{{ $product->name }}</strong></a></td>
                <td class="text-center"><p>{{ $product->quantity }}</p></td>
                <td class="text-center"><p>{{ $product->price }}</p></td>
                <td class="text-center"><p>{{ $product->stock }}</p></td>
                <td class="text-center"><a href="{{ url(app()->getLocale().'/products/'.$product->slug) }}"><img src="../img/{{$product->image}}" style="width:200px; height:200px;" alt="{{ $product->name }}"/></a></td>
                <td><p>{!! Str::limit($product->description, 100) !!}</p></td>
                <td><p>{!! Str::limit($product->properties, 100) !!}</p></td>
                <td><p>{!! Str::limit($product->uses, 100) !!}</p></td> 
                <td>
                    <a class="btn btn-success m-2" href="{{ url(app()->getLocale().'/products/'.$product->slug) }}">{{ __('Details') }}</a><br>
                    <a class="btn btn-primary m-2" href="{{ url(app()->getLocale().'/products/'.$product->slug.'/edit') }}">{{ __('Modify') }}</a><br>
                    <button class="btn btn-danger m-2" id="{{ $product->slug }}" onclick="deleteProduct(this.id)">{{ __('Delete') }}</button>
                </td>
            </tr>
             @endforeach
        @else
            <tr>
                <td colspan="4"> {{ __('There are no products in the database!') }}</td>
            </tr>
        @endif
        </table>
        <div class="float-right m-4">
            <a class="btn btn-info m-4" href="{{ url(app()->getLocale().'/admin') }}">{{ __('Back') }}</a>
        </div>
        <!-- Page numbering -->
        {{$products->render()}} 
    </div>
 </div>
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
                $('.alert').addClass(' alert-success');
                $('#messageResp').html('Produs sters cu succes!');
            } else {
                alert('A intervenit o eroare');
            }
        })
    }
}
 </script>
@endsection