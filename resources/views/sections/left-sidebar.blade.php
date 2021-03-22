<!--Left Sidebar Holder -->
<nav id="sidebar" class="active">
            <div class="sidebar-header">
                <h3><i class="fas fa-bars"></i> {{ __('MENU') }}</h3>
            </div>
            <ul class="list-unstyled components">
                <li class="{{ Request::is('home') ? 'active' : '' }}">
                    <a href="{{ route('/', app()->getLocale()) }}">{{ __('Home') }}</a>
                </li>
                <li class="{{ Request::is('about') ? 'active' : '' }}">
                    <a href="{{ route('about', app()->getLocale()) }}">{{ __('About us') }}</a>
                </li>
                <li class="{{ Request::is('manufacture') ? 'active' : '' }}">
                    <a href="{{ route('manufacture', app()->getLocale()) }}">{{ __('Processing') }}</a>
                </li>
                @if(Auth::guard('user')->check() || Auth::guest())
                <li class="{{ Request::is('details') ? 'active' : '' }}"><!-- Link with dropdown items -->
                        <a class="dropdown-toggle" href="#homeSubmenu" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="homeSubmenu"><i class="fas fa-list-ol"></i> {{ __('Products') }}</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                                <a href="{{ url(app()->getLocale().'/details/1') }}">{{ __('Lavender Oil') }}</a>
                            </li>
                            <li>
                                <a href="{{ url(app()->getLocale().'/details/2') }}">{{ __('Floral water') }}</a>
                            </li>
                            <li>
                                <a href="{{ url(app()->getLocale().'/details/3') }}">{{ __('Soap') }}</a>
                            </li>
                            <li>
                                <a href="{{ url(app()->getLocale().'/details/4') }}">{{ __('Syrup') }}</a>
                            </li>
                            <li>
                                <a href="{{ url(app()->getLocale().'/details/5') }}">{{ __('Floral bouquets') }}</a>
                            </li>
                            <li>
                                <a href="{{ url(app()->getLocale().'/details/6') }}">{{ __('Fire briquettes') }}</a>
                            </li>
                        </ul>
                </li>
                @elseif(Auth::guard('admin')->check())
                <li class="{{ Request::is('products') ? 'active' : '' }}"><!-- Link with dropdown items -->
                        <a class="dropdown-toggle" href="#homeSubmenu" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="homeSubmenu"><i class="fas fa-list-ol"></i> {{ __('Products') }}</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                                <a href="/products/1">{{ __('Lavender Oil') }}</a>
                            </li>
                            <li>
                                <a href="/products/2">{{ __('Floral water') }}</a>
                            </li>
                            <li>
                                <a href="/products/3">{{ __('Soap') }}</a>
                            </li>
                            <li>
                                <a href="/products/4">{{ __('Syrup') }}</a>
                            </li>
                            <li>
                                <a href="/products/5">Buchete florale</a>
                            </li>
                            <li>
                                <a href="/products/6">{{ __('Fire briquettes') }}</a>
                            </li>
                        </ul>
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