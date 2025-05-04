<header class="navbar">
    <div class="navbar-content">
        <a href="{{route('questions.index')}}" class="logo-link">
            <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="logo">
        </a>
        
        <nav>
            <ul>
                <li><a href="#" class="active">Questions</a></li>
            </ul>
        </nav>

        <div class="auth-buttons">
            @guest
            {{-- button non connecter  --}}
                <a href="{{ route('register.index') }}" class="btn btn-primary">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21"
                              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    S'inscrire
                </a>
                <a href="{{ route('login.index') }}" class="btn btn-secondary">Se connecter</a>
            @else
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Mon compte</a>

                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-secondary" style="margin-left: 10px;">Déconnexion</button>
                </form>
            @endguest
        </div>
    </div>
</header>
