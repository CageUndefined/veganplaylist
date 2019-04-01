<footer class="main-footer">
    <div class="container-fluid">
        <div class=" navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="https://youaretheirvoice.com/">You Are Their Voice</a>
                </li>
                <li class="nav-item d-none d-md-inline-block">
                    <span class="nav-link text-white">&#8226;</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="https://veganhacktivists.org/">Vegan Hactivists</a>
                </li>
            </ul>

            @if (!isset($suppressFooter) || !$suppressFooter)
                <ul class="navbar-nav ml-auto align-items-start align-items-md-center">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/contact">Suggest a video</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/contact">Report a video</a>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</footer>

