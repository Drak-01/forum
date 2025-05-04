<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $question->title }} - Forum Étudiant</title>
    <style>
        .post-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .question-card, .response-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
        }
        .post-tags {
            display: flex;
            gap: 8px;
            margin: 15px 0;
        }
        .tag {
            background: #e0f2fe;
            color: #0369a1;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8em;
        }
        .post-footer {
            display: flex;
            gap: 15px;
            color: #64748b;
            font-size: 0.9em;
        }
        .vote-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <div class="post-container">
        <!-- Question -->
        <div class="question-card">
            <div class="post-header">
                <img src="{{ $question->user->userPicture ?? 'https://i.pravatar.cc/40?img='.$question->user->id }}" 
                     alt="Avatar de {{ $question->user->username }}" class="avatar">
                <div>
                    <strong>{{ $question->user->username }}</strong><br>
                    <small>{{ $question->datePost->diffForHumans() }}</small>
                </div>
            </div>
            
            <h1>{{ $question->title }}</h1>
            <p>{{ $question->content }}</p>
            
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
                <span>👁️ {{ rand(50, 200) }}</span>
                <span>💬 {{ $question->reponses->count() }}</span>
            </div>
        </div>
        
        <!-- Réponses -->
        <h2>Réponses ({{ $question->reponses->count() }})</h2>
        
        @foreach($question->reponses as $reponse)
            <div class="response-card">
                <div class="post-header">
                    <img src="{{ $reponse->user->userPicture ?? 'https://i.pravatar.cc/40?img='.$reponse->user->id }}" 
                         alt="Avatar de {{ $reponse->user->username }}" class="avatar">
                    <div>
                        <strong>{{ $reponse->user->username }}</strong><br>
                        <small>{{ $reponse->datePost->diffForHumans() }}</small>
                    </div>
                </div>
                
                <p>{{ $reponse->content }}</p>
                
                <div class="post-footer">
                    <button class="vote-btn">⬆️</button>
                    <span>{{ $reponse->votes->sum('nbreVote') }} votes</span>
                </div>
            </div>
        @endforeach
        
        <!-- Formulaire de réponse -->
        <div class="response-form">
            <h3>Poster une réponse</h3>
            <form action="{{ route('reponses.store', $question) }}" method="POST">
                @csrf
                <textarea name="content" rows="5" style="width: 100%; padding: 10px;" required></textarea>
                <button type="submit" style="margin-top: 10px; padding: 8px 16px; background: #3b82f6; color: white; border: none; border-radius: 4px;">Envoyer</button>
            </form>
        </div>
    </div>
</body>
</html>