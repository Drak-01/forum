<aside class="right-sidebar">
    <section class="sidebar-section">
        <h3>Must-read posts</h3>
        <ul>
            <li><a href="#">Please read rules before you start working on a platform</a></li>
            <li><a href="#">Vision & Strategy of Alemhelp</a></li>
        </ul>
    </section>
    
    <section class="sidebar-section">
        <h3>Featured links</h3>
        <ul>
            <li><a href="#">Alemhelp source-code on GitHub</a></li>
            <li><a href="#">Golang best-practices</a></li>
            <li><a href="#">Alem.School dashboard</a></li>
        </ul>
    </section>
    
    {{-- <section class="sidebar-section">
        <h3>Popular Groups</h3>
        <ul class="groups-list">
            @foreach($groups as $group)
                <li class="group-item">
                    <a href="{{ route('groups.show', $group) }}" class="group-link">
                        <div class="group-avatar">
                            <img src="{{ $group->groupPicture ?? 'https://via.placeholder.com/40' }}" alt="{{ $group->name }}">
                        </div>
                        <div class="group-info">
                            <strong>{{ $group->name }}</strong>
                            <small>{{ $group->users_count }} members</small>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
        <a href="{{ route('groups.index') }}" class="see-all">See all groups</a>
    </section> --}}
    <section class="sidebar-section">
        <div class="section-header">
            <h3>Communautés récentes</h3>
            <a href="{{ route('groups.index') }}" class="see-all">Voir tout</a>
        </div>
        
        <div class="groups-grid">
            @foreach($groups as $group)
                <div class="group-card">
                    <a href="{{ route('groups.show', $group) }}" class="group-link">
                        <div class="group-cover">
                            <img src="{{ $group->groupPicture ?? 'https://via.placeholder.com/300x100?text='.$group->name }}" 
                                 alt="Cover image for {{ $group->name }}">
                        </div>
                        <div class="group-content">
                            <div class="group-avatar">
                                <img src="{{ $group->user->userPicture ?? 'https://i.pravatar.cc/40?img='.$group->user->id }}" 
                                     alt="Avatar de {{ $group->user->username }}">
                            </div>
                            <h4 class="group-name">{{ $group->name }}</h4>
                            <p class="group-description">{{ Str::limit($group->description, 60) }}</p>
                            <div class="group-meta">
                                <span class="members-count">{{ $group->users_count }} membres</span>
                                <span class="created-date">Créé {{ $group->createdAt->diffForHumans() }}</span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
</aside>

<style>
    .right-sidebar {
        width: 300px;
        padding: 20px;
    }
    
    .sidebar-section {
        margin-bottom: 25px;
    }
    
    .sidebar-section h3 {
        font-size: 16px;
        margin-bottom: 12px;
        color: #333;
        font-weight: 600;
    }
    
    .sidebar-section ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .sidebar-section li {
        margin-bottom: 8px;
    }
    
    .sidebar-section a {
        color: #555;
        text-decoration: none;
        transition: color 0.2s;
    }
    
    .sidebar-section a:hover {
        color: #3b82f6;
    }
    
    /* Styles spécifiques pour les groupes */
    .groups-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    .group-item {
        padding: 8px 0;
        border-bottom: 1px solid #eee;
    }
    
    .group-link {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .group-avatar img {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        object-fit: cover;
    }
    
    .group-info {
        line-height: 1.4;
    }
    
    .group-info strong {
        font-size: 14px;
        display: block;
    }
    
    .group-info small {
        font-size: 12px;
        color: #777;
    }
    
    .see-all {
        display: inline-block;
        margin-top: 10px;
        font-size: 13px;
        color: #3b82f6;
    }
</style>