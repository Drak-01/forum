<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENSIASD</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
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
</body>
</html>
