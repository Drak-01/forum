@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="collectives-title">Groupes Collectifs</h1>
    
    <div class="collectives-grid">
        @forelse($groups ?? [] as $group)
            <div class="collective-card">
                <div class="collective-header">
                    <div class="collective-icon">
                        {{ substr($group->name, 0, 2) }}
                    </div>
                    <div class="collective-title">
                        <h4>{{ $group->name }}</h4>
                        <span class="members-count">{{ $group->users_count }} Members</span>
                    </div>
                </div>

                <p class="collective-description">
                    {{ Str::limit($group->description, 90) }}
                </p>

                <div class="collective-actions">
                    <a href="{{ route('group.show', $group->id) }}" class="view-link">Voir</a>
                    @if (Auth::check())
                        @if (!$group->users->contains(Auth::id()))
                            <form action="{{ route('user.group.join', $group->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="join-btn">Join</button>
                            </form>
                        @else
                            <span class="member-badge">Member</span>
                        @endif
                    @else
                        <a href="{{ route('login.index') }}" class="join-btn">Join</a>
                    @endif
                </div>
            </div>
        @empty
            <div class="no-groups">
                <p>Aucun groupe disponible pour le moment.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection

<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .collectives-title {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }
    
    .collectives-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
    }
    
    .collective-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        padding: 20px;
        transition: transform 0.3s ease;
    }
    
    .collective-card:hover {
        transform: translateY(-5px);
    }
    
    .collective-header {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }
    
    .collective-icon {
        width: 40px;
        height: 40px;
        background-color: #4a6fa5;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-weight: bold;
    }
    
    .collective-title h4 {
        margin: 0;
        color: #333;
    }
    
    .members-count {
        font-size: 0.8rem;
        color: #666;
    }
    
    .collective-description {
        color: #555;
        font-size: 0.9rem;
        margin-bottom: 20px;
    }
    
    .collective-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .view-link {
        color: #4a6fa5;
        text-decoration: none;
        font-weight: 500;
    }
    
    .view-link:hover {
        text-decoration: underline;
    }
    
    .join-btn {
        background-color: #4a6fa5;
        color: white;
        border: none;
        padding: 5px 15px;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        font-size: 0.8rem;
    }
    
    .join-btn:hover {
        background-color: #3a5a80;
    }
    
    .member-badge {
        background-color: #e8f0fe;
        color: #4a6fa5;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 0.8rem;
    }
    
    .no-groups {
        grid-column: 1 / -1;
        text-align: center;
        padding: 40px;
        color: #666;
    }
</style>