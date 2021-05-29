@extends('layouts.master')
@section('content')
<div class="container">
<h1 class="text-center">{{ __('Users') }} Control Panel</h1>
 <div class="alert">
    <p id="messageResp"></p>
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
            <a class="btn btn-info" href="{{ url(app()->getLocale().'/admin') }}">{{ __('Back') }}</a>
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
            $(".alert").addClass("alert-success"); 
            $("#messageResp").html("Utilizatorul a fost sters din baza de date");  
        }) 
        .catch(function (error) {
            alert('A intervenit o eroare. Va rugam sa incercati din nou');
        }) 
    }
}
</script>
@endsection