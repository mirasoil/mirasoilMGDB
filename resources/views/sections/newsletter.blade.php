@if (\Session::has('success'))
<div class="alert alert-success">
    <p>{{ \Session::get('success') }}</p>
</div><br />
@endif
@if (\Session::has('failure'))
<div class="alert alert-danger">
    <p>{{ \Session::get('failure') }}</p>
</div><br />
@endif
<form method="post" action="{{url(app()->getLocale().'/newsletter')}}" class="newsletter">
    @csrf
    <input type="text" placeholder="{{ __('Email Address') }}"> 
    <button class="newsletter_submit_btn" type="submit"><i class="fa fa-paper-plane"></i></button>  
</form>
