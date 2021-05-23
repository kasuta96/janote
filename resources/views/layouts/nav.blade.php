<nav class="navbar navbar-light bg-white shadow-sm sticky-top">
    <div class="container-fluid px-0">
        <div>
            <button class="btn btn-light btn-sm mr-2" id="sidebar-toggle"><span class="navbar-toggler-icon"></span></button>
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

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
                    <a id="navbarDropdown" class="nav-link text-secondary dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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