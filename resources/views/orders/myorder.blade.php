@extends('layouts.master')
@section('title')
<title>{{ __("My Order")}} - Mirasoil</title>
@endsection
@section('extra-scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
@endsection
@section('content')
<div class="container">
   <nav aria-label="breadcrumb" class="main-breadcrumb mt-4">
      <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/user') }}">{{ __('My Account') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/myorders') }}">{{ __('My Orders') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Order') }} <?php echo substr($orders['_id'], -6) ?></li>
      </ol>
   </nav>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-4">
    <h5 class="my-5">{{ __('User Details') }}</h5>
         <div class="form-group">
            <p><strong>{{ __('First Name') }}: </strong><em><strong>{{$orders['billing_fname']}} {{$orders['billing_lname']}}</strong></em></p>
         </div>
         <div class="form-group">
            <p><strong>{{ __('Last Name') }}: </strong><em><strong>{{$orders['billing_email']}}</strong></em></p>
         </div>
         <div class="form-group">
            <p><strong>{{ __('Phone') }}: </strong><em><strong> {{$orders['billing_phone']}}</strong></em></p>
         </div>
         <div class="form-group">
            <p><strong>{{ __('Address') }}: </strong><em><strong> {{$orders['billing_address']}}</strong></em></p>
         </div>
         <div class="form-group">
            <p><strong>{{ __('County') }}: </strong><em><strong> {{$orders['billing_county']}}</strong></em></p>
         </div>
         <div class="form-group">
            <p><strong>{{ __('City') }}: </strong><em><strong> {{$orders['billing_city']}}</strong></em></p>
         </div>
         <div class="form-group">
            <p><strong>{{ __('Zipcode') }}: </strong><em><strong> {{$orders['billing_zipcode']}}</strong></em></p>
         </div>
         <div class="form-group">
            
            <p><strong>{{ __('Total') }}: </strong><em><strong> {{$orders['billing_total']}}</strong></em></p>
         </div>
         <div class="form-group">
            <p><strong>Status: </strong><em><strong> {{ $orders['shipped'] === "1" ? __('Shipped') : __('Not shipped') }}</strong></em></p>
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
                     <a href="{{url(app()->getLocale().'/details', $product->slug)}}" style="text-decoration:none;"><p>{{ $product->name }}</p></a>
                  </td>
                  <td><a href="{{url(app()->getLocale().'/details', $product->slug)}}"><img src="../../img/{{$product['image']}}" width="100" height="100"></a></td>
                  <td>
                     <p>{{$product->price}} <small>RON</small></p>
                  </td>
                  @for($i = 0; $i < count($products); $i++)
                  <!--Only if the product id from the orders is the same as the product id from products then that is the right quantity -->
                     @if($orders['products'][$i]['product_id'] == $product->id)
                        <td><p>{{ $orders['products'][$i]['quantity'] }} <small>buc</small></p></td>
                     @endif
                  @endfor
                  <td>
                     <p>{{$orders['created_at']->isoFormat('D MMM YYYY hh:mm') }}</p>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
         <div class="float-right m-4">
            <a class="btn btn-dark" href="{{ url(app()->getLocale().'/invoice/'.$orders->id) }}">{{ __('Invoice') }}</a>
            <a class="btn btn-info m-4" href="{{ url(app()->getLocale().'/myorders') }}">{{ __('Back') }}</a>
        </div>
    </div>
  </div>
</div>
</div>
<div class="p-5"></div>
@endsection
