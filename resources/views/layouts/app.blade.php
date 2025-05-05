<!DOCTYPE html>
<html lang="en" data-bs-theme="{{ session('theme', 'auto') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENSIASD</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/users.css') }}">


    <style>
       @media (prefers-color-scheme: dark) {
        .element {
            color: var(--bs-primary-text-emphasis);
            background-color: var(--bs-primary-bg-subtle);
        }
        }
    </style>
</head>
<body  data-bs-theme="dark">
    @include('partials.nav')

    <div class="main-container">
        @include('partials.left-sidebar')

        <main class="content">
            @yield('content')
        </main>

        @include('partials.right-sidebar')
    </div>

    @include('partials.footer')

    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fonction pour appliquer le thème
            function applyTheme(theme) {
                let effectiveTheme = theme;
                
                // Si le thème est auto, on détecte la préférence système
                if (theme === 'auto') {
                    effectiveTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                }
                
                // Appliquer le thème au document
                document.documentElement.setAttribute('data-bs-theme', effectiveTheme);
                
                // Sauvegarder la préférence
                localStorage.setItem('bsTheme', theme);
                
                // Mettre à jour l'état actif dans le dropdown
                document.querySelectorAll('[data-bs-theme-value]').forEach(el => {
                    el.classList.toggle('active', el.getAttribute('data-bs-theme-value') === theme);
                });
                
                // Envoyer la préférence au serveur (optionnel)
                if (typeof csrfToken !== 'undefined') {
                    fetch('/set-theme', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ theme: theme })
                    });
                }
            }

            // Initialisation
            const savedTheme = localStorage.getItem('bsTheme') || 'auto';
            applyTheme(savedTheme);
            
            // Gestion des clics sur le dropdown
            document.querySelectorAll('[data-bs-theme-value]').forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const theme = this.getAttribute('data-bs-theme-value');
                    applyTheme(theme);
                });
            });
            
            // Écouter les changements de préférence système (pour le mode auto)
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
                if (localStorage.getItem('bsTheme') === 'auto') {
                    applyTheme('auto');
                }
            });
        });
    </script>
</body>
</html>