@extends('layouts.master')
@section('title')
<title>{{ __('Messages') }} - Admin</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
 <div class="container">
  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/admin') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Messages') }}</li>
        </ol>
    </nav>
    <div class="panel-body">
        <div class="alert d-none"> 
            <h5 id="messageRes"></h5>
        </div>
    </div>
    @if (count($messages) > 0) 
    <ul class="message-list">
        @foreach($messages as $key => $message)
        <div class="list-group my-2" id="message-{{$message->id}}">
            <span class="d-none">{{ ++$i }}</span>
            <div class="list-group-item list-group-item-action flex-column align-items-start mt-5">
                    <div class="d-flex w-100 justify-content-between">
                        <h3 class="mb-1">{{ $message->subject }}</h3>
                            <small class="h5">
                            <i class="fas fa-mail-bulk"></i> {{ $message->created_at->isoFormat('D MMM YYYY')}}
                            </small>
                    </div>
                    <p class="mt-3"><strong>{{ __('From') }}: </strong> <span class="h5 text-dark"> {{ $message->name }}  </span> <strong class="ml-4"> {{ __('Email') }}: </strong> <span class="h5 text-dark"> {{ $message->email }}</span></p>
                    <p>{{ __('Phone') }}:  <span class="h5 text-dark"> {{ $message->phone }}</span></p>
                    <p>{{ __('Message') }}: <span class="h5 text-dark">{!! Str::limit($message->message, 100) !!}</span></p>
                    <!-- Button trigger modal -->
                    <a tabindex="0" class="btn btn-info" role="button" data-toggle="popover" data-trigger="focus" title="{{ __('Message content') }}" data-content="{{ $message->message }}"><i class="far fa-envelope-open"></i>  {{ __('Read message') }}</a>
                    <a class="btn btn-success float-right" href="mailto:{{$message->email}}"><i class="fas fa-reply"></i> {{ __('Respond') }}</a>
                    <button class="btn btn-danger float-right mr-3" id="{{ $message->id }}" onclick="deleteMessage(this.id)">{{ __('Delete') }}</button> 
            </div>
            
        </div>
        @endforeach
    </ul>
    @else 
        <div>
            <h5> {{ __('There are no messages in the database!') }}</h5>
        </div>
    @endif
    <div class="float-right mt-4">
            <a class="btn btn-lg btn-info" href="{{ url(app()->getLocale().'/admin') }}">{{ __('Back') }}</a>
        </div>
        <!-- Page numbering -->
        {{$messages->render()}} 
</div>
<div class="mt-5 pt-5"></div>
<div class="mt-5 pt-5"></div>
<script>
//Delete message
function deleteMessage(id){
    if(confirm('Sunteti sigur ca doriti stergerea permanenta a mesajului ?')){
        axios
        .delete("{{ url(app()->getLocale().'/messages/') }}"+'/'+id, {
            data:{
                _token:'{{ csrf_token() }}',
                'id': id
            }
        })
        .then(res => {
            if (res.status === 200) {
                $("#message-"+id).remove();
                $('.alert').removeClass('d-none');
                $('.alert').addClass(' alert-success');
                $('#messageRes').html('Mesaj sters cu succes!');
            } else {
                alert('A intervenit o eroare');
            }
        })
    }
}
$(function () {
  $('[data-toggle="popover"]').popover()
})
 </script>
@endsection