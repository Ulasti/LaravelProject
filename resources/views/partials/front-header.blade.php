<header>
    <nav>
        <a href="{{ url('/') }}">{{ config('app.name') }}</a>
        <ul>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="#">Shop</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
            @guest
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @endguest
            @auth
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout ({{ Auth::user()->name }})</button>
                    </form>
                </li>
            @endauth
        </ul>
    </nav>
</header>