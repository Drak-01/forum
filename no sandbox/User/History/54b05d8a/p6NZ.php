@extends('layouts.app')

@section('content')
<div class="group-container">
    <div class="group-header">
        <div class="group-icon">
            {{ substr($group->name, 0, 2) }}
        </div>
        <div class="group-info">
            <h1>{{ $group->name }}</h1>
            <div class="group-meta">
                <span class="members-count">{{ $group->users_count }} membres</span>
                <span class="created-date">Créé {{ $group->createdAt() }}</span>
                @if(Auth::check() && $group->user_id === Auth::id())
                    <span class="owner-badge">Propriétaire</span>
                @endif
            </div>
        </div>
        @auth
            @if($group->users->contains(Auth::id()))
                <button class="leave-btn">Quitter</button>
            @else
                <button class="join-btn">Rejoindre</button>
            @endif
        @endauth
    </div>

    <div class="group-description">
        <h3>Description</h3>
        <p>{{ $group->description }}</p>
    </div>

    <div class="group-content">
        <div class="group-members">
            <h3>Membres</h3>
            <div class="members-grid">
                @foreach($group->users->take(12) as $user)
                    <div class="member">
                        <img src="{{ $user->userPicture ?? 'https://i.pravatar.cc/40?img='.$user->id }}" 
                             alt="{{ $user->username }}" class="member-avatar">
                        <span class="member-name">{{ $user->username }}</span>
                    </div>
                @endforeach
                @if($group->users_count > 12)
                    <div class="more-members">
                        +{{ $group->users_count - 12 }} autres
                    </div>
                @endif
            </div>
        </div>

        <div class="group-discussions">
            <h3>Discussions récentes</h3>
            @forelse($group->questions as $question)
                <div class="discussion-card">
                    <a href="{{ route('questions.show', $question) }}" class="discussion-title">{{ $question->title }}</a>
                    <div class="discussion-meta">
                        <span>Par {{ $question->user->username }}</span>
                        <span>{{ $question->datePost->diffForHumans() }}</span>
                        <span>{{ $question->reponses_count }} réponses</span>
                    </div>
                </div>
            @empty
                <p>Aucune discussion pour le moment.</p>
            @endforelse
        </div>
    </div>
</div>

<style>
    .group-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .group-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }
    
    .group-icon {
        width: 80px;
        height: 80px;
        border-radius: 12px;
        background: linear-gradient(135deg, #3b82f6, #6366f1);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        font-weight: bold;
    }
    
    .group-info {
        flex-grow: 1;
    }
    
    .group-info h1 {
        margin: 0;
        font-size: 28px;
        color: #222;
    }
    
    .group-meta {
        display: flex;
        gap: 15px;
        margin-top: 8px;
        color: #64748b;
        font-size: 14px;
        align-items: center;
    }
    
    .owner-badge {
        background: #10b981;
        color: white;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 12px;
    }
    
    .join-btn, .leave-btn {
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        border: none;
        transition: all 0.2s;
    }
    
    .join-btn {
        background: #3b82f6;
        color: white;
    }
    
    .join-btn:hover {
        background: #2563eb;
    }
    
    .leave-btn {
        background: #f8fafc;
        color: #ef4444;
        border: 1px solid #ef4444;
    }
    
    .leave-btn:hover {
        background: #fee2e2;
    }
    
    .group-description {
        margin-bottom: 30px;
    }
    
    .group-description h3 {
        font-size: 18px;
        margin-bottom: 10px;
        color: #222;
    }
    
    .group-description p {
        color: #555;
        line-height: 1.6;
    }
    
    .group-content {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 30px;
    }
    
    .group-members h3, .group-discussions h3 {
        font-size: 18px;
        margin-bottom: 15px;
        color: #222;
    }
    
    .members-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 15px;
    }
    
    .member {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .member-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 5px;
    }
    
    .member-name {
        font-size: 12px;
        text-align: center;
        color: #555;
    }
    
    .more-members {
        display: flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
        font-size: 13px;
    }
    
    .discussion-card {
        padding: 15px;
        border-radius: 8px;
        background: #f8fafc;
        margin-bottom: 10px;
    }
    
    .discussion-title {
        font-weight: 500;
        color: #3b82f6;
        text-decoration: none;
        display: block;
        margin-bottom: 5px;
    }
    
    .discussion-title:hover {
        text-decoration: underline;
    }
    
    .discussion-meta {
        display: flex;
        gap: 15px;
        font-size: 13px;
        color: #64748b;
    }
</style>

<script>
    document.querySelectorAll('.join-btn, .leave-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const isJoin = this.classList.contains('join-btn');
            const groupId = {{ $group->id }};
            
            fetch(`/groups/${groupId}/${isJoin ? 'join' : 'leave'}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    window.location.reload();
                }
            });
        });
    });
</script>
@endsection