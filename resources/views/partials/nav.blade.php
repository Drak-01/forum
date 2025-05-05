<header class="navbar">
    <div class="navbar-content">
        <a href="{{ route('questions.index') }}" class="logo-link">
            <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="logo">
        </a>

        
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
                <form class="d-flex position-relative m-0" method="GET">
                    <input class="form-control rounded-pill pe-4 +-0" type="search" 
                        placeholder="Rechercher..." name="q" style="width: 250px;">
                    <button class="btn position-absolute end-0 border-0 bg-transparent" type="submit">
                        <svg width="16" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="currentColor" stroke-width="2"/>
                            <path d="M21 21L16.65 16.65" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </button>
                </form>

                <div class="d-flex align-items-center">
                    <!-- Notification bell -->
                    <div class="position-relative me-2">
                        <button class="btn p-0 border-0 bg-transparent">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 8C18 5.79086 16.2091 4 14 4H10C7.79086 4 6 5.79086 6 8V10C6 11.6569 5.32843 13 4.5 14H19.5C18.6716 13 18 11.6569 18 10V8Z" stroke="currentColor" stroke-width="2"/>
                                <path d="M13.73 21C13.5544 21.3031 13.3041 21.5544 13.0011 21.73C12.6981 21.9056 12.3538 22 12 22C11.6462 22 11.3019 21.9056 10.9989 21.73C10.6959 21.5544 10.4456 21.3031 10.27 21" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-primary border border-light rounded-circle"></span>
                        </button>
                </div>

                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="bi 
                            @if(session('theme', 'auto') === 'light') bi-sun 
                            @elseif(session('theme', 'auto') === 'dark') bi-moon 
                            @else bi-circle-half 
                            @endif
                        "></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#" data-bs-theme-value="light">
                                <i class="bi bi-sun-fill me-2"></i> Clair
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#" data-bs-theme-value="dark">
                                <i class="bi bi-moon-stars-fill me-2"></i> Sombre
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#" data-bs-theme-value="auto">
                                <i class="bi bi-circle-half me-2"></i> Auto
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                        <img src="{{ asset('storage/' . Auth::user()->userPicture) }}" 
                        class="rounded-circle me-2" 
                        width="30" height="30" 
                        alt="Photo de profil">
                        <span>{{ Auth::user()->username }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('user.profile') }}">Paramètre</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Déconnexion</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endguest
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </div>
</header>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const themeSwitcher = document.querySelectorAll('[data-bs-theme-value]');
        const savedTheme = localStorage.getItem('bsTheme') || 'auto';
        
        // Appliquer le thème sauvegardé au chargement
        document.documentElement.setAttribute('data-bs-theme', savedTheme);
        
        // Mettre à jour l'état actif
        document.querySelectorAll('[data-bs-theme-value]').forEach(el => {
            el.classList.toggle('active', el.getAttribute('data-bs-theme-value') === savedTheme);
        });
        
        // Gérer les clics sur les options de thème
        themeSwitcher.forEach(item => {
            item.addEventListener('click', function() {
                const theme = this.getAttribute('data-bs-theme-value');
                document.documentElement.setAttribute('data-bs-theme', theme);
                localStorage.setItem('bsTheme', theme);
                
                // Mettre à jour l'état actif
                document.querySelectorAll('[data-bs-theme-value]').forEach(el => {
                    el.classList.toggle('active', el.getAttribute('data-bs-theme-value') === theme);
                });
            });
        });
    });
</script>