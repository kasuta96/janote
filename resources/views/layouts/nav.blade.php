<nav class="navbar navbar-light bg-white shadow-sm sticky-top">
    <div class="container-fluid px-0">
        <div>
            <button class="btn btn-light btn-sm mr-2" id="sidebar-toggle"><span class="navbar-toggler-icon"></span></button>
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        @if(!Route::is('notes') && !Route::is('fcards'))
        <!-- Search Form -->
        <form action="{{ route('notes') }}" method="get" class="search-form">
            <input type="text" placeholder="Search" name="kw">
            <button type="submit"><i data-feather="search"></i></button>
        </form>
        @endif
        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent"> -->
            <!-- Right Side Of Navbar -->

            <ul class="nav">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link text-secondary" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link text-secondary" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="d-flex align-items-center text-secondary dropdown-toggle py-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <span class="avatar-sm">
                            <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}">
                        </span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <div class="d-flex align-items-center p-2">
                            <div class="avatar">
                                <img
                                alt="{{ Auth::user()->name }}"
                                src="{{ Auth::user()->avatar }}"
                                />
                            </div>
                            <div
                                class="flex-column pl-2 text-nowrap text-truncate"
                                style="width: calc(100% - 40px); max-width: 300px"
                            >
                                <a href="{{ route('profile') }}">
                                    <h5 class="mb-0 text-dark">{{ Auth::user()->name }}</h5>
                                </a>
                                <small>{{ Auth::user()->email }}</small>
                            </div>
                        </div>
                        <hr class="dropdown-divider">
                        <a href="{{ route('profile') }}" class="dropdown-item">{{ __('Profile') }}</a>
                        <a
                            class="dropdown-item"
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                
                @endguest
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i data-feather="globe"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="">
                    @foreach (Config::get('languages') as $lang => $language)
                        <a class="dropdown-item @if ($lang == App::getLocale())active @endif" href="{{ route('lang.switch', $lang) }}"> {{$language}}</a>
                    @endforeach
                    </div>
                </li>
            </ul>
        <!-- </div> -->
    </div>
</nav>
