@inject('app', 'Illuminate\Contracts\Foundation\Application')
@inject('urlGenerator', 'Illuminate\Routing\UrlGenerator')
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
        @if(Auth::guard('user')->check()) 
          @if(Request::is(app()->getLocale().'/shop') OR Request::is(app()->getLocale().'/cart')) 

          @else
            <div class="row mx-5" style="width:10%;" id="mini-cart">
              <a href="{{ url(app()->getLocale().'/cart') }}">
                <button type="button" class="btn btn-info"  id="cart-button" style="height:38px;;">
                  <i class="fa fa-shopping-cart" aria-hidden="true"></i> {{ __('Cart') }} <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                </button>
              </a>
            </div>
          @endif
        @endif
        <div class="butonDreapta">
        <ul class="nav-item d-inline-block ml-auto mr-5" style="list-style:none;">
          <li id="language-switcher"><language-switcher
            locale="{{ app()->getLocale() }}"
            link-ro="{{ route(Route::currentRouteName(), ['locale' => 'ro', 'id' => '/{id?}']) }}"
            link-en="{{ route(Route::currentRouteName(), ['locale' => 'en','id' => '/{id?}']) }}"></language-switcher> 
          </li>
        </ul>
          <button type="button" id="sidebarCollapseRight" class="navbar-btn d-inline-block ml-auto active">
            <span>
              <i class="fa fa-user" aria-hidden="true"></i>
            </span>
          </button>
        </div>
    </div>
</nav>