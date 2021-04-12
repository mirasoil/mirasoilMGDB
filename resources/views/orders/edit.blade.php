@extends('layouts.master')
@section('title')
<title>Modificare comandă - Admin</title>
@endsection
@section('content')
<div class="container">
    <h1 class="text-center">{{ __('Order no.') }} {{ $order->id }}</h1>
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
        <form id="orderForm">
        <div class="form-group">
            <input type="text" class="form-control d-none" id="orderId" value="{{ $order->id }}">

            <label for="billing_fname"><strong>{{ __('First Name') }}</strong></label>
            <input type="text" name="billing_fname" class="form-control" id="billing_fname" value="{{$order->billing_fname }}"> 
        </div>
        <div class="form-group">
            <label for="billing_lname"><strong>{{ __('Last Name') }}</strong></label>
            <input type="text" name="billing_lname" class="form-control" id="billing_lname" value="{{$order->billing_lname }}"> 
        </div>
        <div class="form-group">
            <label for="billing_email"><strong>{{ __('Email') }}</strong></label>
            <input type="text" name="billing_email" class="form-control" id="billing_email" value="{{ $order->billing_email }}">
        </div>
        <div class="form-group">
            <label for="billing_phone"><strong>{{ __('Phone') }}</strong></label>
            <input type="text" name="billing_phone" class="form-control" id="billing_phone" value="{{ $order->billing_phone }}">
        </div>
        <div class="form-group">
            <label for="billing_address"><strong>{{ __('Address') }}</strong></label>
            <input type="text" name="billing_address" class="form-control" id="billing_address" value="{{$order->billing_address }}">
        </div>
        <div class="form-group">
            <label for="billing_county"><strong>{{ __('County') }}</strong></label>
            <input type="text" name="billing_county" class="form-control" id="billing_county" value="{{$order->billing_county }}">
        </div>
        <div class="form-group">
            <label for="billing_city"><strong>{{ __('City') }}</strong></label>
            <input type="text" name="billing_city" class="form-control" id="billing_city" value="{{ $order->billing_city }}">
        </div>
        <div class="form-group">
            <label for="billing_zipcode"><strong>{{ __('Zipcode') }}</strong></label>
            <input type="text" name="billing_zipcode" class="form-control" id="billing_zipcode" value="{{ $order->billing_zipcode }}">
        </div>
        <div class="form-group">
            <label for="billing_total"><strong>{{ __('Total') }}</strong></label>
            <input type="text" name="billing_total" class="form-control" id="billing_total" value="{{ $order->billing_total }}">
        </div>
        <div class="form-group">
            <label for="shipped"><strong>Status</strong></label>
            <input type="number" name="shipped" class="form-control" id="shipped" value="{{ $order->shipped ? 1 : 0 }}"> 
        </div>
        <div class="form-group">
            <button class="btn btn-info" id="updateOrderDetails" data-id="{{ $order->id }}">{{ __('Save') }}</button>
            <a href="{{url(app()->getLocale().'/orders') }}" class="btn btn-danger">{{ __('Cancel') }}</a>
            <a class="btn btn-info float-right" href="{{ url(app()->getLocale().'/orders') }}">{{ __('Back') }}</a>
        </div>
        </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
   //Updating order info
   $('#updateOrderDetails').on('click', function() {
     var order_id = $('#orderId').val();

     var billing_fname = $('#billing_fname').val();
     var billing_lname = $('#billing_lname').val();
     var billing_email = $('#billing_email').val();
     var billing_phone = $('#billing_phone').val();
     var billing_address = $('#billing_address').val();
     var billing_county = $('#billing_county').val();
     var billing_city = $('#billing_city').val();
     var billing_zipcode = $('#billing_zipcode').val();
     var billing_total = $('#billing_total').val();
     var shipped = $('#shipped').val();

     if(billing_fname!="" && billing_lname!="" && billing_email!="" && billing_phone!="" && billing_address!="" && billing_county!="" && billing_city!="" && billing_zipcode!="" && billing_total!=""){
         $.ajax({
             url: "{{ url(app()->getLocale().'/order/edit/') }}"+'/'+order_id,
             type: "PATCH",
             data: {
                 _token: '{{ csrf_token() }}',
                 order_id: order_id,
                 billing_fname: billing_fname,
                 billing_lname: billing_lname,
                 billing_email: billing_email,
                 billing_phone: billing_phone,
                 billing_address: billing_address,
                 billing_county: billing_county,
                 billing_city: billing_city,
                 billing_zipcode: billing_zipcode,
                 billing_total: billing_total,
                 shipped: shipped
             },
             cache: false,
             success: function(dataResult){
                //  console.log(dataResult);
                 var dataResult = JSON.parse(dataResult);
                 if(dataResult.statusCode==200){			
                   console.log('success');              //all data is passed as query strings!!!!!!!!!!!!!!!
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

//onclick="updateOrderDetails(this)"

// function updateOrderDetails(order) {
//     var order_id = $(order).data('id');
//     formData = document.getElementById('orderForm');
//     formObject = new FormData(formData);
//     configs = {method: "PATCH", body:formObject, _token: '{{ csrf_token() }}',};
//     fetch("{{ url(app()->getLocale().'/order/edit/') }}"+'/'+order_id, configs)
//         .then((data) => {
//             console.log('success');
//         })
// }
</script>
@endsection
