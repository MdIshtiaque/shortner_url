<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('home') }}">URL Shortener</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
            </li>
            @if(auth()->check() != '')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.dashboard') }}">Dashboard</a>
                </li>
            @endif
        </ul>
        <span class="navbar-text">
            @if(auth()->check() == '')
                <div class="d-flex align-items-center">
                    <a href="{{ route('login') }}" class="btn btn-primary ml-2">Login</a>
                    <form action="{{ route('register') }}" method="get">
                    @csrf
                    <button type="submit" class="btn btn-success ml-2">Signup</button>
                </form>
            </div>
            @else
                <div class="d-flex align-items-center">
                    <p class="pr-2 pl-5 mb-0"><span style="font-weight: bold">Hi, {{ auth()->user()->name }}</span></p>
                    <form action="{{ route('logoutUser') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-success">Log out</button>
                    </form>
                </div>
            @endif
        </span>
    </div>
</nav>
