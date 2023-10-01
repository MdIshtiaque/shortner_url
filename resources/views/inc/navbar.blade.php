<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('home') }}">Link Shortener</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
            </li>
            @if (auth()->check() != '')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">Dashboard</a>
                </li>
            @endif
        </ul>
        <ul class="navbar-nav ml-auto">
            @if (auth()->check() == '')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Signup</a>
                </li>
            @else
                <p class="pr-2 pl-5 mb-0"><span class="nav-link" style="font-weight: bold">Hi,
                        {{ auth()->user()->name }}</span></p>
                <li class="nav-item">
                    <form action="{{ route('logoutUser') }}" method="post">
                        @csrf
                        <button class="btn nav-link">Logout</button>
                    </form>
                </li>
            @endif
        </ul>
    </div>
</nav>
