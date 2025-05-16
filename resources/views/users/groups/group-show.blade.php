@extends('layouts.app')

@section('content')
<div class="container-fluid px-0">
    <!-- Header avec navigation -->
    <header class="bg-primary text-white shadow-sm">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center py-3">
                <h1 class="h4 mb-0 text-center w-100">{{ $group->name }}</h1>
            </div>
            
            <nav class="navbar navbar-expand navbar-dark bg-primary p-0">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('user.group.show', $group) }}">
                            <i class="fas fa-question-circle me-1"></i> Questions
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.group.messages', $group) }}">
                            <i class="fas fa-comments me-1"></i> Discussion
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.group.membres', $group) }}">
                            <i class="fas fa-users me-1"></i> Membres
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Contenu principal - Questions par défaut -->
    <main class="container py-4">
        <div class="bg-white rounded shadow-sm p-3 mb-4">
            @yield('content-group')

        </div>
    </main>
</div>
@endsection