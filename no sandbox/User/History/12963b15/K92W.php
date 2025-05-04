
@extends('layouts.app')

@section('content')
    <div class="filter-tabs">
        <button class="filter-tab active" onclick="filterQuestions('new')">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            New
        </button>
        <button class="filter-tab" onclick="filterQuestions('top')">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 20V10M12 20V4M6 20v-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            Top
        </button>

        <button class="filter-tab">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2v8M12 18v4M4.93 10.93l1.41 1.41M17.66 11.66l1.41 1.41M2 18h20M4 21h16" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Hot
        </button>
        <button class="filter-tab">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M7 11V7a5 5 0 0110 0v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            Closed
        </button>
    </div>

    <style>
        .filter-tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .filter-tab {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            background: none;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            color: #555;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .filter-tab:hover {
            background: #f5f5f5;
        }
        
        .filter-tab.active {
            background: #3b82f6;
            color: white;
        }
        
        .filter-tab.active svg {
            stroke: white;
        }
        
        .posts-container {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        
        .post-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            padding: 16px;
        }
        
        .post-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }
        
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .post-header div {
            line-height: 1.4;
        }
        
        .post-header strong {
            font-weight: 600;
        }
        
        .post-header small {
            font-size: 12px;
            color: #777;
        }
        
        .post-title {
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 8px;
            color: #3b82f6;
            text-decoration: none;
            display: block;
        }
        
        .post-title:hover {
            text-decoration: underline;
        }
        
        .post-content {
            color: #555;
            line-height: 1.5;
            margin-bottom: 12px;
        }
        
        .post-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin: 12px 0;
        }
        
        .tag {
            display: inline-block;
            background: #f0f5ff;
            color: #3b82f6;
            border-radius: 20px;
            padding: 4px 10px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .post-footer {
            display: flex;
            gap: 20px;
            font-size: 14px;
            color: #777;
        }
        
        .post-footer span {
            display: flex;
            align-items: center;
            gap: 4px;
        }
    </style>

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

    <div class="pagination">
        {{ $questions->links() }}
    </div>

    <script>
        function filterQuestions(type) {
            // Enlever la classe active de tous les boutons
            document.querySelectorAll('.filter-tab').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Ajouter la classe active au bouton cliqué
            event.target.classList.add('active');
            
            // Rediriger avec le paramètre de filtre
            window.location.href = "{{ route('questions.index') }}?filter=" + type;
        }
        
        // Activer le bon filtre au chargement
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const filter = urlParams.get('filter');
            
            if(filter) {
                document.querySelectorAll('.filter-tab').forEach(btn => {
                    btn.classList.remove('active');
                    if(btn.textContent.trim().toLowerCase() === filter) {
                        btn.classList.add('active');
                    }
                });
            }
        });
    </script>
@endsection