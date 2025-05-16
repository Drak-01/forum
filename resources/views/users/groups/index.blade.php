@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md mx-auto">
            <!-- En-tête avec bouton de création -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Mes Groupes</h1>
                <a href="{{ route('user.user.groups.creer') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i> Créer un groupe
                </a>
            </div>

            <!-- Liste des groupes -->
            <div class="card shadow-sm">
                <div class="card-body">
                    @if($groups->isEmpty())
                        <div class="text-center py-5">
                            <i class="bi bi-people display-4 text-muted"></i>
                            <p class="mt-3 text-muted">Vous n'avez pas encore de groupes</p>
                            <a href="{{ route('user.user.groups.creer') }}" class="btn btn-primary mt-2">
                                Créer votre premier groupe
                            </a>
                        </div>
                    @else
                        <div class="list-group list-group-flush">
                            @foreach($groups as $group)
                            <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        @if($group->image)
                                        <img src="{{ asset('storage/'.$group->image) }}" 
                                             class="rounded-circle" 
                                             width="50" height="50" 
                                             alt="{{ $group->name }}">
                                        @else
                                        <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center" 
                                             style="width: 50px; height: 50px;">
                                            <span class="text-white fs-5">{{ strtoupper(substr($group->name, 0, 1)) }}</span>
                                        </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h5 class="mb-1">{{ $group->name }}</h5>
                                        <small class="text-muted">
                                            Créé le {{-- {{ $group->created_at->format('d/m/Y') }} •  --}}
                                            {{ $group->members_count }} membres
                                        </small>
                                    </div>
                                </div>
                                <div class="btn-group">
                                    <a href="{{ route('groups.show', $group->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i> Voir
                                    </a>
                                    <a href="" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-pencil"></i> Modifier
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $groups->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .list-group-item {
        transition: all 0.2s ease;
    }
    .list-group-item:hover {
        background-color: var(--bs-light);
        transform: translateX(2px);
    }
    [data-bs-theme="dark"] .list-group-item:hover {
        background-color: var(--bs-dark-bg-subtle);
    }
</style>
@endpush