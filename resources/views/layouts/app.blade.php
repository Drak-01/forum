<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Métadonnées -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ENSIASD - Plateforme d'échanges et de questions">
    <title>ENSIASD</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

    <!-- Polices -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/users.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
    <!-- Structure principale -->
    @include('partials.nav')

    <div class="main-container">
        @include('partials.left-sidebar')

        <main class="content p-1">
            @yield('content')
        </main>

        @include('partials.right-sidebar')
    </div>

    @include('partials.footer')

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

</body>
</html>