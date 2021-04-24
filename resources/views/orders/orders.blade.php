@extends('layouts.master')
@section('title')
<title>{{ __('Orders Editor') }} - Admin</title>
@endsection
@section('extra-scripts')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="container">
<h3 class="text-center">{{ __('Orders Editor') }}</h3>
    <div class="alert"> <!--- mesaje de succes pt insert delete ---->
        <p id="message-response"></p>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <!---Capul de tabel care ramane mereu la fel, nu depinde de foreach--->
            <table class="table table-bordered table-stripped">
            <tr>
                <th>{{ __('Order ID') }}</th>
                <th>{{ __('User ID') }}</th>
                <th>{{ __('Date') }}</th>
                <th>{{ __('Total') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
            @foreach($orders as $order)
            <tr id="order-{{ $order->id }}">
                <div class="d-none">{{ ++$i }}</div>
                <td>
                    <a href="{{ url(app()->getLocale().'/order/'.$order['id']) }}">{{ $order['id'] }}</a>
                </td>
                <td>
                    <a href="{{ url(app()->getLocale().'/user/'.$order['user_id']) }}">{{ $order['user_id'] }}</a>
                </td>
                <td>{{$order->created_at->isoFormat('D MMM YYYY')}}</td>
                <td>{{ $order['billing_total'] }} RON</td>
                <td>
                    <p id="shipping-response-{{ $order->id }}">
                        @if(!$order->shipped)
                            {{ __('Not shipped') }}
                        @else
                            {{ __('Shipped') }}
                        @endif
                    </p>
                </td>
                <td> 
                <a class="btn btn-success m-2" href="{{ url(app()->getLocale().'/order',$order->id) }}">{{ __('Details') }}</a><br>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal-{{ $order->id }}">
                    {{ __('Modify') }}
                    </button><br>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal-{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ __('Modify shipping status') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="shipped"><strong>Status</strong></label>
                                <input type="number" name="shipped" class="form-control" id="shipped-{{ $order->id }}" value="{{ $order->shipped }}" min="0" max="1"><br> 
                                <h6 class="text-center">0 - {{ __('Not shipped') }}</h6>
                                <h6 class="text-center">1 - {{ __('Shipped') }}</h6>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                            <button type="button" class="btn btn-primary" id="{{ $order->id }}" onclick="setShipping(this.id)">{{ __('Save') }}</button>
                        </div>
                        </div>
                    </div>
                    </div> <!--- --->
                    <button class="btn btn-danger m-2" id="{{ $order->id }}" onclick="deleteOrder(this.id)">{{ __('Delete') }}</button>
                </td>
            </tr>
            @endforeach
            </table>
            <div class="float-right m-4">
                <a class="btn btn-info m-4" href="{{ url(app()->getLocale().'/admin') }}">{{ __('Back') }}</a>
            </div>
            <div class="float-right">{{$orders->render()}}</div><br>
        </div>
    </div>
 </div>
 @for($i=0;$i<=7;$i++)
 <br>
 @endfor
 <script>
 function deleteOrder(id){
    if(confirm('Are you sure you want to permanently delete this order ? This action can\'t be undone.')){
        $.ajax({
            url : "{{ url(app()->getLocale().'/order/') }}"+'/'+id,
            type: "DELETE",
            data:{
                _token:'{{ csrf_token() }}',
                'id': id
            },
            success: function(data){
                $("#order-"+id).remove();
            }
        });
    }
}

 function setShipping(order_id){
    var shipped = $('#shipped-'+order_id).val();
    let currentUrl = "{{ url(app()->getLocale().'/orders') }}";
        $.ajax({
            url : "{{ url(app()->getLocale().'/order/edit') }}"+'/'+order_id,
            type: "PATCH",
            data:{
                _token:'{{ csrf_token() }}',
                order_id: order_id,
                shipped: shipped
            },
            success: function(data){
                var data = JSON.parse(data);
                 if(data.statusCode==200){			
                    $('.modal').modal('hide');
                    $('.modal-backdrop').remove();
                    $(".alert").addClass("alert-success");  //stilizare
                    $("#message-response").html("Status comandă actualizat"); 
                    $('#shipping-response-'+order_id).load(currentUrl+' #shipping-response-'+order_id);
                 }
                 else if(data.statusCode==201){
                    alert("Error occured !");
                 }
            }
        });
}
</script>
@endsection




