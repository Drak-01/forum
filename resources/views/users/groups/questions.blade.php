@extends('users.groups.group-show')

@section('content-group')
    <div class="container">
        <!-- En-tête du groupe -->
        

        <!-- Filtres -->
        <div class="filter-tabs mb-4">
            <button class="filter-tab {{ request('filter') === 'new' || !request('filter') ? 'active' : '' }}" 
                    onclick="filterQuestions('new')">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Récentes
            </button>
            <button class="filter-tab {{ request('filter') === 'top' ? 'active' : '' }}" 
                    onclick="filterQuestions('top')">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 20V10M12 20V4M6 20v-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                Populaires
            </button>
            <button class="filter-tab {{ request('filter') === 'hot' ? 'active' : '' }}" 
                    onclick="filterQuestions('hot')">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2v8M12 18v4M4.93 10.93l1.41 1.41M17.66 11.66l1.41 1.41M2 18h20M4 21h16" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Actives
            </button>
        </div>

        <!-- Bouton pour poser une question -->
        @auth
            @if($group->members->contains(auth()->id()))
                <div class="askbutton d-flex justify-content-end mb-4">
                    <a href="{{ route('user.group.questions.create', $group->id) }}" class="btn shadow-sm"
                       style="background-color: #f57c00; color: white; font-weight: 600; white-space: nowrap; padding: 6px 12px;">
                        <i class="bi bi-plus-lg me-1"></i> Poser une question
                    </a>
                </div>
            @endif
        @endauth

        <!-- Liste des questions -->
        <div class="posts-container">
            @forelse ($questions as $question)
                <div class="post-card mb-3">
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

                    <a href="{{ route('user.group.questions.show', [$group->id, $question->id]) }}" class="post-title">
                        {{ $question->title }}
                    </a>

                    <p class="post-content">{{ Str::limit($question->content, 150) }}</p>

                    @if ($question->tags->count() > 0)
                        <div class="post-tags">
                            @foreach ($question->tags as $tag)
                                <span class="tag"
                                    style="background-color: {{ $tag->color }}20; color: {{ $tag->color }};">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                    <div class="post-footer">
                        <span>👁️ {{ rand(50, 200) }}</span>
                        <span>💬 {{ $question->reponses_count }} réponses</span>
                        <span>⬆️ {{ $question->votes_count }} votes</span>
                    </div>
                </div>
            @empty
                <div class="alert alert-info">
                    Aucune question dans ce groupe pour le moment.
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        {{-- <div class="d-flex justify-content-center mt-4">
            {{ $questions->links() }}
        </div> --}}
    </div>

    <style>
        .group-header {
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

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

    <script>
        function filterQuestions(type) {
            // Mettre à jour l'URL avec le nouveau filtre
            const url = new URL(window.location.href);
            url.searchParams.set('filter', type);
            window.location.href = url.toString();
        }
    </script>
@endsection