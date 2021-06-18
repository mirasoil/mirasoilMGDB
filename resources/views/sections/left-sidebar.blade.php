<!--Left Sidebar Holder -->
<nav id="sidebar" class="active">
            <div class="sidebar-header">
                <h3><i class="fas fa-bars"></i> {{ __('MENU') }}</h3>
            </div>
            <ul class="list-unstyled components">
                <li class="{{ Request::is(app()->getLocale()) ? 'active' : '' }}">
                    <a href="{{ route('/', app()->getLocale()) }}">{{ __('Home') }}</a>
                </li>
                <li class="{{ Request::is(app()->getLocale().'/about') ? 'active' : '' }}">
                    <a href="{{ route('about', app()->getLocale()) }}">{{ __('About us') }}</a>
                </li>
                <li class="{{ Request::is(app()->getLocale().'/manufacture') ? 'active' : '' }}">
                    <a href="{{ route('manufacture', app()->getLocale()) }}">{{ __('Processing') }}</a>
                </li>
                @if(Auth::guard('user')->check() || Auth::guest())
                <li class="{{ Request::is(app()->getLocale().'/details') ? 'active' : '' }}"><!-- Link with dropdown items -->
                        <a class="dropdown-toggle" href="#homeSubmenu" role="button" data-toggle="collapse" id="homeSubmenuActivator" aria-expanded="false" aria-controls="#homeSubmenu" ><i class="fas fa-list-ol"></i> {{ __('Products') }}</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                                <a href="{{ url(app()->getLocale().'/details/ulei') }}">{{ __('Lavender Oil') }}</a>
                            </li>
                            <li>
                                <a href="{{ url(app()->getLocale().'/details/hidrolat') }}">{{ __('Floral water') }}</a>
                            </li>
                            <li>
                                <a href="{{ url(app()->getLocale().'/details/sapun') }}">{{ __('Soap') }}</a>
                            </li>
                            <li>
                                <a href="{{ url(app()->getLocale().'/details/sirop') }}">{{ __('Syrup') }}</a>
                            </li>
                            <li>
                                <a href="{{ url(app()->getLocale().'/details/buchete') }}">{{ __('Floral bouquets') }}</a>
                            </li>
                            <li>
                                <a href="{{ url(app()->getLocale().'/details/brichete') }}">{{ __('Fire briquettes') }}</a>
                            </li>
                        </ul>
                </li>
                <li class="{{ Request::is(app()->getLocale().'/shop') ? 'active' : '' }}">
                    <a href="{{ route('shop', app()->getLocale()) }}"><i class="fas fa-store-alt"></i> {{ __('Shop') }}</a>
                </li>
                @elseif(Auth::guard('admin')->check())
                <li class="{{ Request::is(app()->getLocale().'/products') ? 'active' : '' }}"><!-- Link with dropdown items -->
                        <a class="dropdown-toggle" href="#homeSubmenu" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="homeSubmenu"><i class="fas fa-list-ol"></i> {{ __('Products') }}</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                                <a href="{{ url(app()->getLocale().'/products/ulei') }}">{{ __('Lavender Oil') }}</a>
                            </li>
                            <li>
                                <a href="{{ url(app()->getLocale().'/products/hidrolat') }}">{{ __('Floral water') }}</a>
                            </li>
                            <li>
                                <a href="{{ url(app()->getLocale().'/products/sapun') }}">{{ __('Soap') }}</a>
                            </li>
                            <li>
                                <a href="{{ url(app()->getLocale().'/products/sirop') }}">{{ __('Syrup') }}</a>
                            </li>
                            <li>
                                <a href="{{ url(app()->getLocale().'/products/buchete') }}">Buchete florale</a>
                            </li>
                            <li>
                                <a href="{{ url(app()->getLocale().'/products/brichete') }}">{{ __('Fire briquettes') }}</a>
                            </li>
                        </ul>
                </li>
                <li class="{{ Request::is(app()->getLocale().'/products') ? 'active' : '' }}">
                    <a href="{{ url(app()->getLocale().'/products') }}"><i class="fas fa-store-alt"></i> {{ __('Shop') }}</a>
                </li>
                @endif
                
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-users"></i> Social</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="https://www.facebook.com/mirasoil16/"><i class="fab fa-facebook-square"></i>  Facebook</a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/mirasoil16/"><i class="fab fa-instagram-square"></i> Instagram</a>
                        </li>
                        <li>
                            <a href="https://ro.pinterest.com/mirasoilproduction/boards/"><i class="fab fa-pinterest-square"></i> Pinterest</a>
                        </li>
                    </ul>
                </li>
                </ul>
        </nav>