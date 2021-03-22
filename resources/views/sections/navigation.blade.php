<nav class="mobile navbar navbar-expand-lg sticky-top navbar-light bg-light" id="mobile">
    <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="navbar-btn active">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <!-- Logo -->
        <div class="d-flex justify-content-center">
            <span><a href="{{ route('/', app()->getLocale()) }}"><img src="{{URL::asset('/img/Logo-mirasoil.png')}}" alt="Logo"  width="100"></a></span> 
        </div> 

        @if(Auth::guard('user')->check()) 
          @if(Request::is('shop') OR Request::is('cart'))

          @else
            <div class="row mx-5" style="width:10%;" id="mini-cart">
              <button type="button" class="btn btn-info" onclick="location.href='/cart'" id="cart-button" style="height:38px;;">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Coș <span class="badge badge-pill badge-danger">{{ Cart::count() }}</span>
              </button>
            </div>
          @endif
        @endif
        <div class="butonDreapta">
          <button type="button" id="sidebarCollapseRight" class="navbar-btn d-inline-block ml-auto active">
            <span>
              <i class="fa fa-user" aria-hidden="true"></i>
            </span>
          </button>
        </div>
    </div>
</nav>