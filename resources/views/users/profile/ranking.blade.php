@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Classements</h2>
    
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h3>Top Utilisateurs par Questions</h3>
                </div>
                <div class="card-body">
                    <ol class="list-group list-group-numbered">
                        @foreach($topUsersByQuestions as $user)
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">{{ $user->username }}</div>
                            </div>
                            <span class="badge bg-primary rounded-pill">{{ $user->questions_count }} questions</span>
                        </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h3>Questions les plus actives</h3>
                </div>
                <div class="card-body">
                    <ol class="list-group list-group-numbered">
                        @foreach($topQuestions as $question)
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">{{ Str::limit($question->title, 40) }}</div>
                                <small>Par {{ $question->user->username }}</small>
                            </div>
                            <span class="badge bg-primary rounded-pill">{{ $question->reponses_count }} réponses</span>
                        </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection