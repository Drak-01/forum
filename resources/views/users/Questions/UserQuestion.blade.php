@extends('users.profile.activite')

@section('content-Activites')

    <div class="d-flex align-items-center mb-4">
        <h1 class="mb-0">
            {{ $total }}
        </h1>
        <span class="h4 text-muted ms-2">Questions</span>
    </div>

    <div class="posts-container">
        @foreach($questions as $question)
            <div class="post-card">
                <div class="post-header">
                         <img src="{{ $question->user->userPicture 
                         ? asset('storage/' . $question->user->userPicture) 
                         : 'https://i.pravatar.cc/40?img=' . $question->user->id }}" 
                 alt="Avatar de {{ $question->user->username }}" 
                 class="avatar">
            
                    <div>
                        <strong>{{ $question->user->username }}</strong>
                        <small>{{ $question->datePost() }}</small>
                    </div>
                </div>
                
                <a href="{{ route('questions.show', $question) }}" class="post-title">
                    {{ $question->title }}
                </a>
                
                <p class="post-content">{{ Str::limit($question->content, 150) }}</p>
                
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
                    <span>⬆️ {{ $question->reponses->sum(function($reponse) { return $reponse->votes->sum('nbreVote'); }) }}</span>
                </div>
            </div>
        @endforeach
    </div>
@endsection