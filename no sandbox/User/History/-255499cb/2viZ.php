@extends('layouts.app')

@section('content')
    <style>
        .post-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .question-card, .response-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .post-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }
        
        .post-header strong {
            font-weight: 600;
        }
        
        .post-header small {
            font-size: 12px;
            color: #777;
        }
        
        .question-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #222;
        }
        
        .question-content, .response-content {
            line-height: 1.6;
            color: #555;
            margin-bottom: 15px;
        }
        
        .post-tags {
            display: flex;
            gap: 8px;
            margin: 15px 0;
            flex-wrap: wrap;
        }
        
        .tag {
            display: inline-block;
            background: #f0f5ff;
            color: #3b82f6;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .post-footer {
            display: flex;
            gap: 20px;
            color: #777;
            font-size: 14px;
        }
        
        .vote-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.2em;
            color: #64748b;
        }
        
        .vote-btn:hover {
            color: #3b82f6;
        }
        
        .response-form {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            padding: 20px;
            margin-top: 30px;
        }
        
        .response-form h3 {
            margin-bottom: 15px;
            font-size: 18px;
        }
        
        .response-form textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            min-height: 120px;
            resize: vertical;
        }
        
        .response-form button {
            margin-top: 10px;
            padding: 10px 20px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
        }
        
        .response-form button:hover {
            background: #2563eb;
        }
        
        .responses-title {
            font-size: 20px;
            margin: 30px 0 15px;
            color: #222;
        }
    </style>

    <div class="post-container">
        <!-- Question -->
        <div class="question-card">
            <div class="post-header">
                <img src="{{ $question->user->userPicture 
                ? asset('storage/' . $question->user->userPicture) 
                : 'https://i.pravatar.cc/40?img=' . $question->user->id }}" 
                     alt="Avatar de {{ $question->user->username }}" class="avatar">
                <div>
                    <strong>{{ $question->user->username }}</strong>
                    <small>{{ $question->datePost() }}</small>
                </div>
            </div>
            
            <h1 class="question-title">{{ $question->title }}</h1>
            <div class="question-content">{{ $question->content }}</div>
            
            @if($question->tags->count() > 0)
                <div class="post-tags">
                    @foreach($question->tags as $tag)
                        <span class="tag" style="background-color: {{ $tag->color }}20; color: {{ $tag->color }};">
                            {{ $tag->name }}
                        </span>
                    @endforeach
                </div>
            @endif
            
            <div class="post-footer">
                <span>👁️ {{ rand(50, 200) }} vues</span>
                <span>💬 {{ $question->reponses->count() }} réponses</span>
            </div>
        </div>
        
        <!-- Réponses -->
        <h2 class="responses-title">Réponses ({{ $question->reponses->count() }})</h2>
        
        @forelse($question->reponses as $reponse)
            <div class="response-card">
                <div class="post-header">
                    <img src="{{ $reponse->user->userPicture ?? 'https://i.pravatar.cc/40?img='.$reponse->user->id }}" 
                         alt="Avatar de {{ $reponse->user->username }}" class="avatar">
                    <div>
                        <strong>{{ $reponse->user->username }}</strong>
                        <small>{{ $reponse->datePost->diffForHumans() }}</small>
                    </div>
                </div>
                
                <div class="response-content">{{ $reponse->content }}</div>
                
                <div class="post-footer">
                    <button class="vote-btn">⬆️</button>
                    <span>{{ $reponse->votes->sum('nbreVote') }} votes</span>
                </div>
            </div>
        @empty
            <div class="response-card">
                <p>Aucune réponse pour le moment. Soyez le premier à répondre !</p>
            </div>
        @endforelse
        
        <!-- Formulaire de réponse -->
        <div class="response-form">
            <h3>Poster une réponse</h3>
            <form action="{{ route('reponses.store', $question) }}" method="POST">
                @csrf
                <textarea name="content" rows="5" placeholder="Votre réponse..." required></textarea>
                <button type="submit">Envoyer</button>
            </form>
        </div>
    </div>
@endsection