
<nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-laravel">
    <div class="container-fluid">
        <a href="/"><img src="https://i.imgur.com/Hfkiumn.png" style="width: 300px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto align-items-start align-items-md-center">
            <li class="nav-item">
                    <a class="nav-link text-white" href="/featured"><i class="mr-1 d-md-none d-xl-inline-block fas fa-star"></i>Featured playlists</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/recent"><i class="mr-1 d-md-none d-xl-inline-block fas fa-history"></i>Recently added</a>
                </li>
                <li class="nav-item d-none d-xl-inline-block">
                    <span class="nav-link text-white">&#8226;</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/about"><i class="mr-1 d-md-none d-xl-inline-block fas fa-info-circle"></i>About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" target=_blank href="https://veganhacktivists.org/contact?veganplaylist"><i class="mr-1 d-md-none d-xl-inline-block fas fa-envelope"></i>Contact</a>
                </li>
                <li class="nav-item mx-lg-3">
                    <a
                        class="nav-link text-white btn text-left rounded-pill px-3 mr-3 mr-md-0 font-bold bg-pink"
                        href="https://www.patreon.com/veganhacktivists"
                        target="_blank"
                    >
                        <i class="mr-1 d-md-none d-xl-inline-block fas fa-hand-holding-heart"></i>Donate
                    </a>
                </li>
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown text-white">
                        <a id="navbarDropdown" class="nav-link text-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile', Auth::user() ) }}">
                                My Playlists
                            </a>
                            <a class="dropdown-item" href="{{ route('settings.index') }}">
                                Settings
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"><font color="red">
                                {{ __('Logout') }}</font>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
