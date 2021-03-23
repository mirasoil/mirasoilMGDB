@extends('layouts.master')
@section('title')
<title>Gestionare produse - Admin</title>
@endsection
@section('content')
<h1 class="text-center">Control Panel</h1>
@if ($message = Session::get('success'))
 <div class="alert alert-success"> <!--- mesaje de succes pt insert delete ---->
    <p>{{ $message }}</p>
 </div>
 @endif
 <div class="panel panel-default" style="padding:50px">
    <div class="panel-body">
        <div class="form-group">
            <div class="pull-right">
                <!---Butonul pentru adaugarea unui produs nou--->
                <a href="{{ url(app()->getLocale().'/products/create') }}" class="btn btn-info">Adaugă produs</a>
            </div>
        </div>
        <!---Capul de tabel care ramane mereu la fel, nu depinde de foreach--->
        <table class="table table-bordered table-stripped">
        <tr>
            <th width="50">Id</th>
            <th width="200">Nume</th>
            <th width="80">Cantitate</th>
            <th width="80">Preț</th>
            <th width="80">Stoc</th>
            <th>Imagine</th>
            <th width="250">Descriere</th>
            <th width="250">Proprietăți</th>
            <th width="250">Utilizări</th>
            <th width="100">Acțiuni</th>
        </tr>
        @if (count($products) > 0) <!---Numara cate produse sunt afisate pe ecran. Daca numarul e pozitiv, adica daca exista produse atunci le afisam. Cine e $products ? ---->
            <!---Afisarea propriu zisa a produselor--->
            @foreach ($products as $key => $product)
            <tr>
                <td>{{ ++$i }}</td>
                <td><a href="{{ url(app()->getLocale().'/products/'.$product->slug) }}" style="text-decoration:none;color:gray;font-size:18px;"><strong>{{ $product->name }}</strong></a></td>
                <td class="text-center"><p>{{ $product->quantity }}</p></td>
                <td class="text-center"><p>{{ $product->price }}</p></td>
                <td class="text-center"><p>{{ $product->stock }}</p></td>
                <td class="text-center"><a href="{{ url(app()->getLocale().'/products/'.$product->slug) }}"><img src="../img/{{$product->image}}" style="width:300px; height:250px;" alt="{{ $product->name }}"/></a></td>
                <td><p>{!! Str::limit($product->description, 200) !!}</p></td>
                <td><p>{!! Str::limit($product->properties, 200) !!}</p></td>
                <td><p>{!! Str::limit($product->uses, 200) !!}</p></td> <!---afiseaza doar primele 200 de caractere din descriere --->
                <td>
                    <a class="btn btn-success m-2" href="{{ url(app()->getLocale().'/products/'.$product->slug) }}">Detalii</a><br>
                    <a class="btn btn-primary m-2" href="{{ url(app()->getLocale().'/products/'.$product->slug.'/edit') }}">Modifică</a><br>
                    {{ Form::open(['method' => 'DELETE','url' => [app()->getLocale().'/products/'.$product->slug],'style'=>'display:inline']) }}   <!--se activeaza metoda destroy din ProductController-->
                    {{ Form::submit('Șterge', ['class' => 'btn btn-danger m-2']) }} <!---metoda delete din ProductController functia destroy---->
                    {{ Form::close() }}
                </td>
            </tr>
             @endforeach
        @else
            <tr>
                <td colspan="4">Nu există produse în baza de date!</td>
            </tr>
        @endif
        </table>
        <!-- Introduce nr pagina -->
        {{$products->render()}} <!---rendeaza ? need more info---->
    </div>
 </div>
@endsection