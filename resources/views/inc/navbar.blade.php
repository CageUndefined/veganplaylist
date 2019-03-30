
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
            <ul class="navbar-nav ml-auto">
			<li class="nav-item">
                    <a class="nav-link" href="/featured" style="color:#fff;"><i class="mr-1 d-md-none d-lg-inline-block fas fa-star"></i>Featured</a>
                </li>
				<li class="nav-item">
                    <a class="nav-link" href="/recent" style="color:#fff;"><i class="mr-1 d-md-none d-lg-inline-block fas fa-history"></i>Recent</a>
                </li>
				<li class="nav-item d-none d-lg-inline-block">
                    <a class="nav-link" style="color:#fff;">&#8226;</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color:#fff;" href="/about"><i class="mr-1 d-md-none d-lg-inline-block fas fa-info-circle"></i>About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color:#fff;" href="/contact"><i class="mr-1 d-md-none d-lg-inline-block fas fa-envelope"></i>Contact</a>
                </li>
                <li class="nav-item ml-lg-2">
                    <a class="nav-link text-white btn btn-sm text-left rounded-pill p-2" style="background-color: #ff0097;" href="https://www.patreon.com/youaretheirvoice" target="_blank">
            <i class="mr-1 d-md-none d-lg-inline-block fas fa-hand-holding-heart"></i>Donate
    </a>
                </li>
                <li class="nav-item" style="color:#fff;">
                    <a class="nav-link" style="color:#fff;" href="#"> </a>
                </li>
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" style="color:#fff;" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" style="color:#fff;" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown" style="color:#fff;">
                        <a id="navbarDropdown" style="color:#fff;" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}/{{ Auth::user()->slug }}">
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
