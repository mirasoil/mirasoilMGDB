@extends('layouts.master')
@section('title')
<title>{{ __('Control Panel') }} - Admin</title>
@endsection
@section('content')
<h1 class="text-center">{{ __('Control Panel') }}</h1>
@if ($message = Session::get('success'))
 <div class="alert alert-success mx-5"> <!--- mesaje de succes pt insert delete ---->
    <p>{{ $message }}</p>
 </div>
 @endif
 <div class="panel panel-default" style="padding:50px">
    <div class="panel-body">
        <div class="form-group">
            <div class="pull-right">
                <!---Butonul pentru adaugarea unui produs nou--->
                <a href="{{ url(app()->getLocale().'/products/create') }}" class="btn btn-info">{{ __('Create new product') }}</a>
            </div>
        </div>
        <!---Capul de tabel care ramane mereu la fel, nu depinde de foreach--->
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
        @if (count($products) > 0) <!---Numara cate produse sunt afisate pe ecran. Daca numarul e pozitiv, adica daca exista produse atunci le afisam. Cine e $products ? ---->
            <!---Afisarea propriu zisa a produselor--->
            @foreach ($products as $key => $product)
            <tr>
                <td class="d-none">{{ ++$i }}</td>
                <td><strong><i>{{ $product->slug }}</i></strong></td>
                <td><a href="{{ url(app()->getLocale().'/products/'.$product->slug) }}" style="text-decoration:none;color:gray;font-size:18px;"><strong>{{ $product->name }}</strong></a></td>
                <td class="text-center"><p>{{ $product->quantity }}</p></td>
                <td class="text-center"><p>{{ $product->price }}</p></td>
                <td class="text-center"><p>{{ $product->stock }}</p></td>
                <td class="text-center"><a href="{{ url(app()->getLocale().'/products/'.$product->slug) }}"><img src="../img/{{$product->image}}" style="width:200px; height:200px;" alt="{{ $product->name }}"/></a></td>
                <td><p>{!! Str::limit($product->description, 100) !!}</p></td>
                <td><p>{!! Str::limit($product->properties, 100) !!}</p></td>
                <td><p>{!! Str::limit($product->uses, 100) !!}</p></td> <!---afiseaza doar primele 200 de caractere din descriere --->
                <td>
                    <a class="btn btn-success m-2" href="{{ url(app()->getLocale().'/products/'.$product->slug) }}">{{ __('Details') }}</a><br>
                    <a class="btn btn-primary m-2" href="{{ url(app()->getLocale().'/products/'.$product->slug.'/edit') }}">{{ __('Modify') }}</a><br>
                    {{ Form::open(['method' => 'DELETE','url' => [app()->getLocale().'/products/'.$product->slug],'style'=>'display:inline']) }}   <!--se activeaza metoda destroy din ProductController-->
                    {{ Form::submit(__('Delete'), ['class' => 'btn btn-danger m-2']) }} <!---metoda delete din ProductController functia destroy---->
                    {{ Form::close() }}
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
        <!-- Introduce nr pagina -->
        {{$products->render()}} 
    </div>
 </div>
@endsection