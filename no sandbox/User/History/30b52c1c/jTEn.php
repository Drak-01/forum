<header class="navbar">
    <div class="navbar-content">
        <a href="{{ route('questions.index') }}" class="logo-link">
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
                        <path
                            d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    S'inscrire
                </a>
                <a href="{{ route('login.index') }}" class="btn btn-secondary">Se connecter</a>



                {{-- button connecter --}}





            @else
                <!-- Bouton pour poser une question -->
                <a href="" class="btn btn-primary" style="margin-right: 15px;">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                        style="margin-right: 5px;">
                        <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Poser une question
                </a>

                <!-- Cloche de notification -->
                <div class="notification-icon" style="position: relative; margin-right: 15px;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                        style="cursor: pointer;">
                        <path
                            d="M18 8C18 5.79086 16.2091 4 14 4H10C7.79086 4 6 5.79086 6 8V10C6 11.6569 5.32843 13 4.5 14H19.5C18.6716 13 18 11.6569 18 10V8Z"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M13.73 21C13.5544 21.3031 13.3041 21.5544 13.0011 21.73C12.6981 21.9056 12.3538 22 12 22C11.6462 22 11.3019 21.9056 10.9989 21.73C10.6959 21.5544 10.4456 21.3031 10.27 21"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="notification-dot"
                        style="position: absolute; top: 0; right: 0; background: blue; border-radius: 50%; width: 8px; height: 8px;"></span>
                </div>

                <!-- Image de profil cliquable -->
                <div class="profile-menu" style="position: relative;">
                    <img src="{{ asset(Auth::user()->userPicture ?? 'images/default-profile.png') }}" alt="Profile"
                        class="rounded-full" style="width: 40px; height: 40px; object-fit: cover; cursor: pointer;"
                        onclick="document.getElementById('userModal').style.display = 'block';">
                </div>

                <!-- Modal de profil -->
                <div id="userModal" class="modal"
                    style="display:none; position: absolute; top: 60px; right: 10px; background: white; border: 1px solid #ccc; border-radius: 8px; padding: 10px; z-index: 999;">
                    <div style="text-align: center;">
                        <img src="{{ asset(Auth::user()->userPicture ?? 'images/profile.jpg') }}" alt="Profile"
                            style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%; margin-bottom: 10px;">
                        <p><strong>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</strong></p>
                        <p style="font-size: 0.9em;">{{ Auth::user()->univEmail }}</p>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-secondary" style="margin-top: 10px;">Déconnexion</button>
                        </form>
                    </div>
                    <button onclick="document.getElementById('userModal').style.display = 'none';"
                        style="position: absolute; top: 5px; right: 10px; background: none; border: none; font-size: 18px;">×</button>
                </div>
            @endguest

            {{-- @else
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Mon compte</a>

                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-secondary" style="margin-left: 10px;">Déconnexion</button>
                </form>
            @endguest --}}
        </div>
    </div>
</header>
