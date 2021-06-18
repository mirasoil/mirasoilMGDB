@extends('layouts.master')
@section('title')
<title>{{ __('Order Details')}} - Admin</title>
@endsection
@section('content')
<div class="container">
@foreach($orders as $order)
    <h3 class="text-center">{{ __('Order no.') }} <?php echo substr($order['_id'], -6) ?></h3>
@endforeach
<div class="container-fluid">
   <!-- Breadcrumb -->
   <nav aria-label="breadcrumb" class="main-breadcrumb mt-4">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/admin') }}">{{ __('Home') }}</a></li>
         <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/orders') }}">{{ __('Orders Editor') }}</a></li>
         <li class="breadcrumb-item active" aria-current="page">{{ __('Order no.') }} <?php echo substr($order['_id'], -6) ?></li>
      </ol>
   </nav>
  <div class="row">
    <div class="col-sm-4">
    <h5 class="my-5">{{ __('User Details') }}</h5>
         <div class="form-group">
            <p><strong>{{ __('First Name') }}: </strong><em><strong>{{ $order->billing_fname}}</strong></em></p>
         </div>
         <div class="form-group">
            <p><strong>{{ __('Last Name') }}: </strong><em><strong>{{$order->billing_lname }}</strong></em></p>
         </div>
         <div class="form-group">
            <p><strong>{{ __('Email') }}: </strong><em><strong>{{ $order->billing_email }}</strong></em></p>
         </div>
         <div class="form-group">
            <p><strong>{{ __('Phone') }}: </strong><em><strong> 0{{ $order->billing_phone }}</strong></em></p>
         </div>
         <div class="form-group">
            <p><strong>{{ __('Address') }}: </strong><em><strong> {{ $order->billing_address }}</strong></em></p>
         </div>
         <div class="form-group">
            <p><strong>{{ __('County') }}: </strong><em><strong> {{ $order->billing_county }}</strong></em></p>
         </div>
         <div class="form-group">
            <p><strong>{{ __('City') }}: </strong><em><strong> {{ $order->billing_city }}</strong></em></p>
         </div>
         <div class="form-group">
            <p><strong>{{ __('Zipcode') }}: </strong><em><strong> {{ $order->billing_zipcode }}</strong></em></p>
         </div>
         <div class="form-group">
            
            <p><strong>{{ __('Total') }}: </strong><em><strong> {{ $order->billing_total }}</strong></em></p>
         </div>
         <div class="form-group">
            <p><strong>{{ __('Status') }}: </strong><em><strong> {{ $order->shipped === "1" ? __('Shipped') : __('Not shipped') }}</strong></em></p>
         </div>
    </div>
    <div class="col-sm-8">
    <h5 class="text-center mt-5">{{ __('Ordered products') }}</h5>
         <table class="table mt-3">
            <thead>
               <tr>
                  <th>{{ __('Product Name') }}</th>
                  <th>{{ __('Image') }}</th>
                  <th>{{ __('Price') }}</th>
                  <th>{{ __('Quantity') }}</th>
                  <th>{{ __('Date') }}</th>
               </tr>
            </thead>
            <tbody>
               @foreach($products as $product)
               <tr>
                  <td>
                     <p>{{ $product->name }}</p>
                  </td>
                  <td><img src="../../img/{{$product->image}}" width="100" height="100"></td>
                  <td>
                     <p>{{ $product->price }} RON</p>
                  </td>
                  @for($i = 0; $i < count($products); $i++)
                  <!--Only if the product id from the orders is the same as the product id from products then that is the right quantity -->
                     @if($orders[0]['products'][$i]['product_id'] == $product->id)
                        <td><p>{{ $orders[0]['products'][$i]['quantity'] }} <small>buc</small></p></td>
                     @endif
                  @endfor
                  <td><p>{{ $order->created_at->isoFormat('D MMM YYYY') }}</p></td>
                  <td>
                     
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
         <div class="float-right m-4">
            <a class="btn btn-dark" href="{{ url(app()->getLocale().'/invoices/'.$order->id) }}">{{ __('Invoice') }}</a>
            <a class="btn btn-info ml-2" href="{{ url(app()->getLocale().'/orders') }}">{{ __('Back') }}</a>
        </div>
    </div>
  </div>
</div>
</div>
<div class="p-5"></div>
@endsection