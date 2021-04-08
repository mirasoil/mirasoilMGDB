@extends('layouts.master')
@section('content')
<div class="container">
<h1 class="text-center">{{ __('Users') }} Control Panel</h1>
@if ($message = Session::get('success'))
 <div class="alert alert-success"> <!--- mesaje de succes pt insert delete ---->
    <p>{{ $message }}</p>
 </div>
 @endif
 <div class="panel panel-default" style="padding:50px">
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
                <td>{{$user->id}}</td>
                <td><a href="{{ url(app()->getLocale().'/user/'.$user->id) }}" style="text-decoration:none;color:gray;font-size:18px;"><strong>{{ $user->firstname }}</strong></a></td>
                <td class="text-center"><p>{{ $user->lastname }}</p></td>
                <td class="text-center"><p>{{ $user->email }}</p></td>
                <td class="text-center"><p>{{ $user->phone }}</p></td>
                <td class="text-center"><p>{{ $user->county }}</p></td>
                <td class="text-center">
                    <a class="btn btn-success m-2" href="{{ url(app()->getLocale().'/user/'.$user->id) }}">{{ __('Details') }}</a><br>
                    <a class="btn btn-primary m-2" href="{{ url(app()->getLocale().'/user/edit/'.$user->id) }}">{{ __('Modify') }}</a><br>
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
        <div class="float-right m-4">
            <a class="btn btn-info m-4" href="{{ url(app()->getLocale().'/admin') }}">{{ __('Back') }}</a>
        </div>
        <div class="float-right">{{$users->render()}}</div><br>
    </div>
 </div>
</div>
<script>
function deleteUser(id){
    if(confirm('Are you sure you want to permanently remove the user ? This action cannot be undone.')){
        $.ajax({
            url : "{{ url(app()->getLocale().'/user/') }}"+'/'+id,
            type: "DELETE",
            data:{
                _token:'{{ csrf_token() }}',
                'id': id
            },
            success: function(data){
                $("#user-"+id).remove();
            }
        });
    }
}
</script>
@endsection