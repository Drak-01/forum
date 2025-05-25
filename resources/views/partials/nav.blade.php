<header class="navbar navbar-expand-sm bg-light ">
    <div class="container-fluid">
        <!-- Logo et bouton toggler -->
        <a href="{{ route('questions.index') }}" class="navbar-brand">
            <img src="{{ asset('images/logo.svg') }}" class="logo" width="70" height="40">
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenu principal de la navbar -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Liens de navigation -->
            <ul class="navbar-nav me-auto">
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">About</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Contact</a>
                </li> --}}
            </ul>
            
            <!-- Barre de recherche (visible sur desktop) -->
            <form class="d-none d-md-flex position-relative mx-3" action="{{ route('questions.search') }}" method="GET" style="width: 400px;">
                <input class="form-control rounded-pill pe-5" 
                       type="search" 
                       placeholder="Rechercher..." 
                       name="q">
                <button class="btn position-absolute end-0 top-50 translate-middle-y border-0 bg-transparent" type="submit">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="currentColor" stroke-width="2"/>
                        <path d="M21 21L16.65 16.65" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </button>
            </form>

            <!-- Section authentification -->
            @guest
                <!-- Version non connectée -->
                <div class="d-flex gap-2">
                    <a href="{{ route('register.index') }}" class="btn btn-primary d-flex align-items-center gap-2">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" 
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" 
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        S'inscrire
                    </a>
                    <a href="{{ route('login.index') }}" class="btn btn-outline-secondary">Se connecter</a>
                </div>
            @else
                <!-- Version connectée -->
                <div class="d-flex align-items-center gap-3">
                    <!-- Notification -->
                    <div class="position-relative">
                        <button class="btn p-0 border-0 bg-transparent position-relative">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 8C18 5.79086 16.2091 4 14 4H10C7.79086 4 6 5.79086 6 8V10C6 11.6569 5.32843 13 4.5 14H19.5C18.6716 13 18 11.6569 18 10V8Z" stroke="currentColor" stroke-width="2"/>
                                <path d="M13.73 21C13.5544 21.3031 13.3041 21.5544 13.0011 21.73C12.6981 21.9056 12.3538 22 12 22C11.6462 22 11.3019 21.9056 10.9989 21.73C10.6959 21.5544 10.4456 21.3031 10.27 21" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                        </button>
                    </div>

                    <!-- Menu utilisateur -->
                    <div class="dropdown ">
                        <button class="btn btn-light dropdown-toggle d-flex align-items-center btn_color" type="button" data-bs-toggle="dropdown">
                            <img src="{{ asset('storage/' . Auth::user()->userPicture) }}" 
                                 class="rounded-circle me-2" 
                                 width="32" 
                                 height="32" 
                                 alt="Photo de profil">
                            <span class="d-none d-lg-inline">{{ Auth::user()->username }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item text_color" href="{{ route('user.profile') }}">Profil</a></li>
                            {{-- <li><a class="dropdown-item text_color" href="{{ route('user.activites') }}">Activité</a></li> --}}
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Déconnexion</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            @endguest
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </div>
</header>

