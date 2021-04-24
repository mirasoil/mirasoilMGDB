@section('extra-scripts')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet"/>
@endsection
<nav class="mobile navbar navbar-expand-lg sticky-top navbar-light bg-light" id="mobile">
    <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="navbar-btn active">
            <span></span>
            <span></span>
            <span></span>
        </button>
        @include('sections.search')
        
        <div class="butonDreapta" style="text-align: center;vertical-align: middle;">
          <ul class="nav-item d-inline-block ml-auto mr-3" style="list-style:none;">
            <li id="language-switcher"><language-switcher
              locale="{{ app()->getLocale() }}"
              link-ro="{{ route(Route::currentRouteName(), array_merge(request()->route()->parameters(), [ 'locale' => 'ro' ])) }}"
              link-en="{{ route(Route::currentRouteName(), array_merge(request()->route()->parameters(), [ 'locale' => 'en' ])) }}"></language-switcher> 
            </li>
          </ul> 
          <!---Display cart button only for logged in users--->
          @if(Auth::guard('user')->check()) 
            @if(Request::is(app()->getLocale().'/shop') OR Request::is(app()->getLocale().'/cart') OR Request::is(app()->getLocale().'/revieworder')) 

            @else
              <div class="nav-item d-inline-block mr-4" style="width:auto;height:40px;" id="mini-cart">
                <a href="{{ url(app()->getLocale().'/cart') }}">
                  <button type="button" class="btn btn-light"  id="cart-button" style="height:38px;;">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="badge badge-pill badge-danger float-right">{{ count((array) session('cart')) }}</span>
                  </button>
                </a>
              </div>
            @endif
          @endif
          <!---Display user avatar and name as right navbar button if logged in and avatar is set--->
          @if(Auth::guard('user')->check())
                <div class="navbar-btn d-inline-block ml-auto" id="sidebarCollapseRight">
                @if(Auth::guard('user')->user()->avatar)
                  <img src="{{ asset('uploads/avatars/'.Auth::guard('user')->user()->avatar) }}" class="d-inline-block ml-auto avatar"  alt="avatar" style="width:48px; height:45px;border-radius:50%;">
                @else 
                <img src="{{ asset('uploads/avatars/default.jpg') }}" class="d-inline-block ml-auto avatar"  alt="avatar" style="width:45px; height:45px;border-radius:50%;">
                @endif
                <cite title="Source Title" style="font-size:20px;">{{ Auth::guard('user')->user()->firstname }}&#711;</cite> 
                </div>
            @else
            <button type="button" id="sidebarCollapseRight" class="navbar-btn d-inline-block ml-auto active" style="height:40px;width:40px;">
              <span>
                <i class="fa fa-user" aria-hidden="true"></i>
              </span>
            </button>
          @endif
        </div>
    </div>
</nav>