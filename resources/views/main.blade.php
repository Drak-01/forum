<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlemHelp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <header class="navbar">
        <div class="navbar-content">
            <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="logo">
            <nav>
                <ul>
                    <li><a href="#" class="active">Questions</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                <button class="btn btn-primary">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Register
                </button>
                <button class="btn btn-secondary">Login</button>
            </div>
        </div>
    </header>

    <div class="main-container">
        <aside class="sidebar">
            <div class="search-container">
                <input type="text" placeholder="Search by keywords..." class="search-input">
            </div>
            <nav class="sidebar-nav">
                <h3>MENU</h3>
                <ul>
                    <li class="active"><a href="#">Questions</a></li>
                    <li><a href="#">Tags</a></li>
                    <li><a href="#">Ranking</a></li>
                </ul>
            </nav>
            <div class="social-icons">
                <a href="#" class="social-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <a href="#" class="social-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <a href="#" class="social-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        </aside>

        <main class="content">
            <div class="filter-tabs">
                <button class="filter-tab active">New</button>
                <button class="filter-tab">Top</button>
                <button class="filter-tab">Hot</button>
                <button class="filter-tab">Closed</button>
            </div>

            <div class="posts-container">
                <!-- Post items will be dynamically added here -->
            </div>
        </main>

        <aside class="right-sidebar">
            <section class="sidebar-section">
                <h3>Must-read posts</h3>
                <ul>
                    <li><a href="#">Please read rules before you start working on a platform</a></li>
                    <li><a href="#">Vision & Strategy of Alemhelp</a></li>
                </ul>
            </section>
            <section class="sidebar-section">
                <h3>Featured links</h3>
                <ul>
                    <li><a href="#">Alemhelp source-code on GitHub</a></li>
                    <li><a href="#">Golang best-practices</a></li>
                    <li><a href="#">Alem.School dashboard</a></li>
                </ul>
            </section>
        </aside>
    </div>

    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
