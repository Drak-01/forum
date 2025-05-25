@extends('layouts.app')

@section('content')
<div class="container-fluid px-0">
    <!-- Header avec navigation -->
    <header class="bg-primary text-white shadow-sm">
        <div class="container">
            <!-- Première ligne : Nom du groupe + boutons d'action -->
            <div class="d-flex justify-content-between align-items-center py-3">
                <!-- Nom du groupe centré -->
                <div class="w-100 text-center position-relative">
                    <h1 class="h4 mb-0">{{ $group->name }}</h1>
                    
                    <!-- Boutons Rejoindre/Quitter alignés à droite -->
                    @auth
                        <div class="position-absolute end-0 top-50 translate-middle-y">
                            @if($group->members->contains(auth()->id()))
                                <form action="{{ route('user.group.leave', $group->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-light btn-sm">
                                        <i class="fas fa-sign-out-alt me-1"></i> Quitter
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('user.group.join', $group->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-light btn-sm">
                                        <i class="fas fa-sign-in-alt me-1"></i> Rejoindre
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endauth
                </div>
            </div>   
    
            <!-- Navigation principale -->
            <nav class="navbar navbar-expand navbar-dark bg-primary p-0">
                <ul class="navbar-nav w-100 justify-content-around">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('group.show') ? 'active' : '' }}" 
                           href="{{ route('group.show', $group) }}">
                            <i class="fas fa-question-circle me-1"></i> Questions
                        </a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('user.group.messages') ? 'active' : '' }}" 
                            href="{{ route('user.group.messages', $group) }}">
                                <i class="fas fa-comments me-1"></i> Discussion
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('user.group.membres') ? 'active' : '' }}" 
                            href="{{ route('user.group.membres', $group) }}">
                                <i class="fas fa-users me-1"></i> Membres
                            </a>
                        </li> 
                    @endauth                    
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
<style>
    .nav-link {
        padding: 0.75rem 1rem;
        transition: all 0.2s;
        position: relative;
    }
    
    .nav-link.active {
        font-weight: 500;
        background-color: rgba(255,255,255,0.15);
    }
    
    .nav-link.active:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80%;
        height: 3px;
        background-color: white;
        border-radius: 3px 3px 0 0;
    }
    
    .nav-link:hover:not(.active) {
        background-color: rgba(255,255,255,0.1);
    }
</style>