<!--Right Sidebar Holder --> 
<nav id="sidebar-right" class="active">
            <div class="sidebar-header">
                <h3><i class="fa fa-cog"></i> {{ __('SETTINGS') }}</h3>
            </div>
            <ul class="list-unstyled components">
                <li class="active">
                    <a href="#secondarySubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-user"></i> {{ __('Account') }}</a>
                    <ul class="collapse list-unstyled" id="secondarySubmenu">
                    
                        @if(Auth::guard('user')->check())
                            <li class="{{ Request::is('account') ? 'active' : '' }}">
                                <a href="{{ url(app()->getLocale().'/user') }}"> {{ __('My Account') }}</a>
                            </li>
                            <li class="{{ Request::is('account') ? 'active' : '' }}">
                                <a href="{{ url(app()->getLocale().'/myorders') }}">{{ __('My Orders') }}</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout', app()->getLocale()) }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @elseif(Auth::guard('admin')->check())
                            <li class="{{ Request::is(app()->getLocale().'/admin') ? 'active' : '' }}">
                                <a href="{{ url(app()->getLocale().'/admin') }}">{{ __('Home') }}</a>
                            </li>
                            <li class="{{ Request::is(app()->getLocale().'/products') ? 'active' : '' }}">
                                <a href="{{ route('products.index', app()->getLocale()) }}">{{ __('Control Panel') }}</a>
                            </li>
                            <li class="{{ Request::is(app()->getLocale().'/orders') ? 'active' : '' }}">
                                <a href="{{ url(app()->getLocale().'/orders') }}">{{ __('Orders Editor') }}</a>
                            </li>
                            <li class="{{ Request::is(app()->getLocale().'/users') ? 'active' : '' }}">
                                <a href="{{ url(app()->getLocale().'/users') }}"> {{ __('Users Editor') }}</a>
                            </li>
                            <li class="{{ Request::is(app()->getLocale().'/messages') ? 'active' : '' }}">
                                <a href="{{ url(app()->getLocale().'/messages') }}"> {{ __('Messages Editor') }}</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout', app()->getLocale()) }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>                       
                        @else 
                                <li>
                                    <a href="{{ route('login.default', app()->getLocale()) }}">{{ __('Login') }}</a>
                                </li>     
                                <li>
                                <a href="{{ route('register.user', app()->getLocale()) }}">{{ __('Register') }}</a>
                                </li>                
                        @endif
                    </ul>
                    @if(Auth::guard('user')->check())
                        <li class="{{ Request::is('cart') ? 'active' : '' }}">
                            <a href="{{ url(app()->getLocale().'/cart') }}"><i class="fas fa-shopping-cart"></i> {{ __('Cart') }}</a>
                        </li>
                    @endif
                    <li class="{{ Request::is('transport') ? 'active' : '' }}">
                        <a href="{{ url(app()->getLocale().'/transport') }}"><i class="fa fa-truck"></i> Transport</a>
                    </li>
                    <li class="{{ Request::is('info') ? 'active' : '' }}">
                        <a href="{{ url(app()->getLocale().'/info') }}"><i class="fa fa-info-circle"></i> {{ __('Useful information') }}</a>
                    </li>
                    <li class="{{ Request::is('contact') ? 'active' : '' }}">
                        <a href="{{ url(app()->getLocale().'/#contact') }}"><i class="fa fa-address-book"></i> {{ __('Contact') }}</a>
                    </li>
                    @if(Auth::guard('admin')->check() || Auth::guard('user')->check())
                    
                    @else 
                    <li class="{{ Request::is('admin') ? 'active' : '' }}">
                        <a href="{{ route('login.admin', app()->getLocale()) }}"><i class="fas fa-user-lock"></i> {{ __('Admin') }}</a>
                    </li>
                    @endif
                </ul>
        </nav>