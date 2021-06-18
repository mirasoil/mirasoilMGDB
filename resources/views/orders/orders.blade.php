@extends('layouts.master')
@section('title')
<title>{{ __('Orders Editor') }} - Admin</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('admin-modal-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modal.js" integrity="sha512-Bp1SEH6unclxWdEeJvGQdSKlFarPwBjDVg5uwApgKLdrae0h+NKTcox+MqagH0Xl9dC1jgWdg66wFP4JXumrlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('content')
<div class="container">
    <h3 class="text-center">{{ __('Orders Editor') }}</h3>
    <nav aria-label="breadcrumb" class="main-breadcrumb mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/admin') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Orders Editor') }}</li>
        </ol>
    </nav>
    <div class="alert d-none"> 
        <h5 id="message-response"></h5>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-bordered table-stripped">
            <tr>
                <th>{{ __('Order ID') }}</th>
                <th>{{ __('User ID') }}</th>
                <th>{{ __('Date') }}</th>
                <th>{{ __('Total') }}</th>
                <th>{{ __('Status') }}</th>
                <th class="text-center">{{ __('Actions') }}</th>
            </tr>
            @foreach($orders as $order)
            <tr id="order-{{ $order->id }}">
                <div class="d-none">{{ ++$i }}</div>
                <td>
                    <a href="{{ url(app()->getLocale().'/order/'.$order['id']) }}"><?php echo substr($order['_id'], -6) ?></a>
                </td>
                <td>
                    <a href="{{ url(app()->getLocale().'/user/'.$order['user_id']) }}">{{ $order['user_id'] }}</a>
                </td>
                <td>{{$order->created_at->isoFormat('D MMM YYYY')}}</td>
                <td>{{ $order['billing_total'] }} RON</td>
                <td id="shipping-response-{{ $order->id }}">
                    <p>
                        @if(!$order->shipped)
                            {{ __('Not shipped') }}
                        @else
                            {{ __('Shipped') }}
                        @endif
                    </p>
                </td>
                <td class="text-center"> 
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
            <div class="float-right mt-4">
                <a class="btn btn-lg btn-info mt-4" href="{{ url(app()->getLocale().'/admin') }}">{{ __('Back') }}</a>
            </div>
            <div>{{$orders->render()}}</div><br>
        </div>
    </div>
 </div>
 @for($i=0;$i<=7;$i++)
 <br>
 @endfor
<script>
// Permanently delete an order as admin
function deleteOrder(id){
    let url = "{{ url(app()->getLocale().'/order/') }}"+'/'+id;
    if(confirm('Are you sure you want to permanently delete this order ? This action can\'t be undone.')){
        axios
        .delete(url, {
            data: {    
                _token:'{{ csrf_token() }}',
                "id": id
                }
        })
        .then(response => {
            $("#order-"+id).remove();   
        }) 
        .catch(function (error) {
            alert('A intervenit o eroare. Va rugam sa incercati din nou');
        })
    }
}

// Set shipping status
function setShipping(order_id){
    var shipped = $('#shipped-'+order_id).val();
    let url = "{{ url(app()->getLocale().'/order/edit') }}"+'/'+order_id;
    let currentUrl = "{{ url(app()->getLocale().'/orders') }}";

    let axiosConfig = {
    headers: {
        'Content-Type' : 'application/json; charset=UTF-8',
        'Accept': 'Token',
        "Access-Control-Allow-Origin": "*",
    }
    };
    axios({
      method: 'post',
      url: url,
      headers: axiosConfig,
      data: {
        _token: '{{ csrf_token() }}',
            "order_id": order_id,
            "shipped": shipped
      }
    })
    .then((response) => {			
        $('.modal').modal('hide');
        $('.modal-backdrop').remove();
        $(".alert").removeClass('d-none');
        $(".alert").addClass("alert-success");  //stilizare
        $("#message-response").html("Status comandă actualizat"); 
        // $("#shipping-response-"+order_id).load(" #shipping-response-"+order_id+" > *");
        $('#shipping-response-'+order_id).load(" #shipping-response-"+order_id+" > *");  
    })
    .catch(function (error) {
        alert('A intervenit o eroare. Va rugam sa incercati din nou');
    })
    
}
</script>
@endsection




