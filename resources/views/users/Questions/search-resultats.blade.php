@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Colonne principale -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h5 mb-0">Résultats de recherche</h1>
                        <span class="text-muted small">{{ $questions->total() }} résultats</span>
                    </div>
                </div>

                <!-- Filtres -->
                <div class="card-body border-bottom">
                    <form action="{{ route('questions.search') }}" method="GET">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <input type="text" name="q" class="form-control" placeholder="Rechercher..." value="{{ $searchQuery }}">
                            </div>
                            <div class="col-md-3">
                                <select name="filter" class="form-select">
                                    <option value="new" {{ (request('filter') ?? 'new') === 'new' ? 'selected' : '' }}>Nouveautés</option>
                                    <option value="top" {{ (request('filter') ?? 'new') === 'top' ? 'selected' : '' }}>Top questions</option>
                                    <option value="unanswered" {{ (request('filter') ?? 'new') === 'unanswered' ? 'selected' : '' }}>Sans réponse</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary w-100">Filtrer</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Liste des questions -->
                <div class="list-group list-group-flush">
                    @forelse ($questions as $question)
                        <div class="list-group-item">
                            <div class="d-flex">
                                <!-- Stats -->
                                <div class="text-center pe-3" style="min-width: 80px;">
                                    <div class="mb-1 {{ $question->reponses_count > 0 ? 'text-success' : 'text-muted' }}">
                                        <strong>{{ $question->reponses_count }}</strong>
                                        <div class="small">réponses</div>
                                    </div>
                                    <div class="{{ $question->votes_count > 0 ? 'text-primary' : ($question->votes_count < 0 ? 'text-danger' : 'text-muted') }}">
                                        <strong>{{ $question->votes_count }}</strong>
                                        <div class="small">votes</div>
                                    </div>
                                </div>
                                
                                <!-- Contenu -->
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">
                                        <a href="{{ route('questions.show', $question) }}" class="text-decoration-none">
                                            {{ $question->title }}
                                        </a>
                                    </h5>
                                    
                                    <p class="text-muted small mb-2">
                                        {{ Str::limit(strip_tags($question->content), 200) }}
                                    </p>
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="tags">
                                            @foreach($question->tags as $tag)
                                                <a href="{{ route('questions.search', ['tags[]' => $tag->id]) }}" class="badge bg-secondary text-decoration-none me-1">
                                                    {{ $tag->name }}
                                                </a>
                                            @endforeach
                                        </div>
                                        <div class="text-end">
                                            <small class="text-muted">
                                                Posté {{ $question->datePost() }} par 
                                                <a href="{{ route('questions.search', ['user' => $question->user->id]) }}" class="text-decoration-none">
                                                    {{ $question->user->name }}
                                                </a>
                                                @if($question->group)
                                                    dans <a href="{{ route('questions.search', ['group' => $question->group->id]) }}" class="text-decoration-none">{{ $question->group->name }}</a>
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="list-group-item text-center py-4">
                            <h5 class="text-muted">Aucune question trouvée</h5>
                            <p class="mb-0">Essayez de modifier vos critères de recherche</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($questions->hasPages())
                    <div class="card-footer bg-white">
                        {{ $questions->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h2 class="h6 mb-0">Tags populaires</h2>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($popularTags as $tag)
                            <a href="{{ route('questions.search', ['tags[]' => $tag->id]) }}" class="badge bg-light text-dark text-decoration-none">
                                {{ $tag->name }} <span class="text-muted">({{ $tag->questions_count }})</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection