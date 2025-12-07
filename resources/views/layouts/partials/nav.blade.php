<nav class="navbar navbar-expand-lg navbar-light bg-light my-8 rounded-xl shadow-md">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">GiftShare</a>

        <ul class="navbar-nav ms-auto">
            @auth
                <li class="nav-item">
                    <a class="nav-link" href="/profile">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('items.index') }}">Items</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endauth

            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
            @endguest
        </ul>
    </div>
</nav>
