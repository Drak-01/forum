@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-expand-sm bg-light navbar-light ">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text_color" href="{{ route('user.activites') }}">Groupes</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text_color" href="{{ route('user.activites.questions') }}">Questions</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text_color" href="{{ route('user.activites.responses') }}">Responses</a>
                </li>

            </ul>
        </div>
    </nav>    
    <main class="container-fluid">
        @yield('content-Activites')
    </main>
@endsection