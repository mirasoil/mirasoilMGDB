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
                                <a href="/user"> {{ __('My Account') }}</a>
                            </li>
                            <li class="{{ Request::is('account') ? 'active' : '' }}">
                                <a href="/myorders">{{ __('My Orders') }}</a>
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
                            <li class="{{ Request::is('controlPanel') ? 'active' : '' }}">
                                <a href="/products"><i class="fa fa-user"></i> {{ __('Control Panel') }}</a>
                            </li>
                            <li class="{{ Request::is('account') ? 'active' : '' }}">
                                <a href="/orders">{{ __('Orders Editor') }}</a>
                            </li>
                            <li class="{{ Request::is('account') ? 'active' : '' }}">
                                <a href="/users"> {{ __('Users Editor') }}</a>
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
                                    <a href="{{ route('login.default', app()->getLocale()) }}">{{ __('Login as client') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('login.admin', app()->getLocale()) }}">{{ __('Login as admin') }}</a>
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
                        <a href="{{ url(app()->getLocale().'/#contact') }}"><i class="fa fa-address-book"></i> Contact</a>
                    </li>
                </ul>
        </nav>