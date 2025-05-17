@extends('users.profile.activite')

@section('content-Activites')
<div class="container py-4" style="width: 600px">
    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Détail de votre réponse</h1>
            <p class="text-muted mb-0">Question : {{ $reponse->question->title }}</p>
        </div>
        <span class="badge bg-primary">
            {{ $reponse->votes->sum('nbreVote') }} votes
        </span>
    </div>

    <!-- Carte de la question -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <div class="d-flex align-items-center mb-3">
                <img src="{{ $reponse->question->user->userPicture 
                      ? asset('storage/' . $reponse->question->user->userPicture) 
                      : 'https://i.pravatar.cc/40?img=' . $reponse->question->user->id }}" 
                     class="rounded-circle me-2" width="40" height="40">
                <div>
                    <strong>{{ $reponse->question->user->username }}</strong>
                    <small class="text-muted">{{ $reponse->question->datePost() }}</small>
                </div>
            </div>
            <h2 class="h5">{{ $reponse->question->title }}</h2>
            <div class="question-content mt-3">
                {{ $reponse->question->content }}
            </div>
        </div>
    </div>

    <!-- Votre réponse -->
    <div class="card border-primary shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h2 class="h5 mb-0">Votre réponse</h2>
            <div class="dropdown">
                <button class="btn btn-sm btn-light dropdown-toggle" type="button" 
                        data-bs-toggle="dropdown">
                    Actions
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <button class="dropdown-item" onclick="enableEdit()">
                            <i class="fas fa-edit me-1"></i> Modifier
                        </button>
                    </li>
                    <li>
                        <form id="delete-form" action="{{ route('user.reponses.destroy', $reponse) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="dropdown-item text-danger" 
                                    onclick="return confirm('Supprimer cette réponse ?')">
                                <i class="fas fa-trash me-1"></i> Supprimer
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Affichage normal -->
        <div class="card-body" id="reponse-view">
            <div class="d-flex align-items-center mb-3">
                <img src="{{ $reponse->user->userPicture 
                      ? asset('storage/' . $reponse->user->userPicture) 
                      : 'https://i.pravatar.cc/40?img=' . $reponse->user->id }}" 
                     class="rounded-circle me-2" width="40" height="40">
                <div>
                    <strong>Vous</strong>
                    <small class="text-muted">{{ $reponse->datePost }}</small>
                </div>
            </div>
            
            <div class="reponse-content">
                {!! nl2br(e($reponse->content)) !!}
            </div>
            
            @if($reponse->description)
            <div class="mt-3 p-3 bg-light rounded">
                <h5 class="h6 fw-bold">Détails supplémentaires :</h5>
                {{ $reponse->description }}
            </div>
            @endif
        </div>
        
        <!-- Formulaire d'édition (caché) -->
        <div class="card-body" id="reponse-edit" style="display: none;">
            <form action="{{ route('user.reponses.update', $reponse) }}" method="POST">
                @csrf @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label">Contenu principal</label>
                    <textarea name="content" class="form-control" rows="5" required>{{ $reponse->content }}</textarea>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Détails supplémentaires</label>
                    <textarea name="description" class="form-control" rows="3">{{ $reponse->description }}</textarea>
                </div>
                
                <div class="d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary" onclick="disableEdit()">
                        Annuler
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bouton de retour -->
    <div class="mt-4">
        <a href="{{ route('user.activites.responses') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Retour à mes réponses
        </a>
    </div>
</div>

@section('scripts')
<script>
function enableEdit() {
    document.getElementById('reponse-view').style.display = 'none';
    document.getElementById('reponse-edit').style.display = 'block';
}

function disableEdit() {
    document.getElementById('reponse-edit').style.display = 'none';
    document.getElementById('reponse-view').style.display = 'block';
}
</script>
@endsection
@endsection