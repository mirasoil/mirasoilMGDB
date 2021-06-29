@extends('layouts.master')
@section('content')
<div class="container">
<h1 class="text-center">{{ __('Users') }} Control Panel</h1>
 <!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="main-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/admin') }}">{{ __('Home') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('Users Editor') }}</li>
    </ol>
</nav>
<div class="alert d-none" id="message-response">
    <h5 id="messageResp"></h5>
</div>
 <div class="panel panel-default">
    <div class="panel-body">
        <table class="table table-bordered table-stripped">
        <tr>
            <th>Id</th>
            <th>{{ __('First Name') }}</th>
            <th>{{ __('Last Name') }}</th>
            <th>{{ __('Email') }}</th>
            <th>{{ __('Phone') }}</th>
            <th>{{ __('County') }}</th>
            <th>{{ __('Actions') }}</th>
        </tr>
        @if(count($users) > 0)
            @foreach ($users as $key =>$user)
            <tr id="user-{{ $user->id }}">
                <div class="d-none">{{ ++$i }}</div>
                <td><a class="text-decoration-none" href="{{ url(app()->getLocale().'/user/'.$user->id) }}">{{$user->id}}</a></td>
                <td><a href="{{ url(app()->getLocale().'/user/'.$user->id) }}" style="text-decoration:none;color:gray;font-size:18px;"><strong>{{ $user->firstname }}</strong></a></td>
                <td class="text-center"><p>{{ $user->lastname }}</p></td>
                <td class="text-center"><p>{{ $user->email }}</p></td>
                <td class="text-center"><p>{{ $user->phone }}</p></td>
                <td class="text-center"><p>{{ $user->county }}</p></td>
                <td class="text-center">
                    <a class="btn btn-success m-2" href="{{ url(app()->getLocale().'/user/'.$user->id) }}">{{ __('Details') }}</a><br>
                    <button class="btn btn-danger m-2" id="{{ $user->id }}" onclick="deleteUser(this.id)">{{ __('Delete') }}</button>
                </td>
            </tr>
             @endforeach
        @else
            <tr>
                <td colspan="4">{{ __('There are no users in the database!') }}</td>
            </tr>
        @endif
        </table>
        <div class="float-left">
            <a class="btn btn-lg btn-info" href="{{ url(app()->getLocale().'/admin') }}">{{ __('Back') }}</a>
        </div>
        <div class="float-right">{{$users->render()}}</div><br>
    </div>
 </div>
</div>
<div class="pt-5"></div>
<script>
// Permanently delete an account from database
function deleteUser(id){
    let url = "{{ url(app()->getLocale().'/user/') }}"+'/'+id;
    if(confirm('Are you sure you want to permanently remove the user ? This action cannot be undone.')){
        axios
        .delete(url, {
            data: {    
                _token:'{{ csrf_token() }}',
                "id": id
                }
        })
        .then(response => {
            $("#user-"+id).remove();  
            $(".alert").removeClass('d-none').addClass("alert-success"); 
            $("#messageResp").html("Utilizatorul a fost sters din baza de date");  
            setTimeout(function(){$('#message-response').fadeOut();}, 3000);
        }) 
        .catch(function (error) {
            alert('A intervenit o eroare. Va rugam sa incercati din nou');
        }) 
    }
}
</script>
@endsection