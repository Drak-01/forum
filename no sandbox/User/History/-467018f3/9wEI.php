@extends('layouts.app')

@section('content')
<div class="groups-page">
    <div class="page-header">
        <h1>Communautés</h1>
        <a href="{{ route('groups.create') }}" class="create-btn">Créer une communauté</a>
    </div>

    <div class="groups-grid">
        @foreach($groups as $group)
            <div class="group-card">
                <div class="group-header">
                    <div class="group-icon">
                        {{ substr($group->name, 0, 2) }}
                    </div>
                    <div class="group-info">
                        <h2><a href="{{ route('groups.show', $group) }}">{{ $group->name }}</a></h2>
                        <div class="group-meta">
                            <span>{{ $group->users_count }} membres</span>
                            <span>Créé {{ $group->createdAt->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
                
                <p class="group-description">{{ Str::limit($group->description, 120) }}</p>
                
                <div class="group-actions">
                    @auth
                        @if($group->users->contains(Auth::id()))
                            <span class="member-badge">Membre</span>
                        @else
                            <button class="join-btn" data-group-id="{{ $group->id }}">Rejoindre</button>
                        @endif
                    @else
                        <button class="join-btn" data-group-id="{{ $group->id }}">Rejoindre</button>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>

    <div class="pagination">
        {{ $groups->links() }}
    </div>
</div>

<style>
    .groups-page {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }
    
    .page-header h1 {
        font-size: 28px;
        color: #222;
        margin: 0;
    }
    
    .create-btn {
        background: #3b82f6;
        color: white;
        padding: 10px 20px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        transition: background 0.2s;
    }
    
    .create-btn:hover {
        background: #2563eb;
    }
    
    .groups-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .group-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        transition: transform 0.2s;
    }
    
    .group-card:hover {
        transform: translateY(-5px);
    }
    
    .group-header {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
    }
    
    .group-icon {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        background: linear-gradient(135deg, #3b82f6, #6366f1);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: bold;
        flex-shrink: 0;
    }
    
    .group-info h2 {
        margin: 0;
        font-size: 18px;
    }
    
    .group-info h2 a {
        color: #222;
        text-decoration: none;
    }
    
    .group-info h2 a:hover {
        color: #3b82f6;
    }
    
    .group-meta {
        display: flex;
        gap: 10px;
        font-size: 13px;
        color: #64748b;
        margin-top: 5px;
    }
    
    .group-description {
        color: #555;
        line-height: 1.5;
        margin-bottom: 15px;
    }
    
    .group-actions {
        display: flex;
        justify-content: flex-end;
    }
    
    .join-btn {
        background: #3b82f6;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 6px 12px;
        font-size: 14px;
        cursor: pointer;
        transition: background 0.2s;
    }
    
    .join-btn:hover {
        background: #2563eb;
    }
    
    .member-badge {
        background: #ecfdf5;
        color: #10b981;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
    }
    
    .pagination {
        display: flex;
        justify-content: center;
    }
</style>

<script>
    document.querySelectorAll('.join-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const groupId = this.dataset.groupId;
            
            fetch(`/groups/${groupId}/join`, {
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