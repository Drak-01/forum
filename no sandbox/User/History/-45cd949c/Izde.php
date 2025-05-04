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
    <section class="collectives-section">
        <div class="section-header">
            <h3>Collectives</h3>
            <a href="{{ route('groups.index') }}" class="see-all">see all</a>
        </div>
        
        <div class="collectives-list">
            @foreach($groups as $group)
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
                        <a href="{{ route('groups.show', $group) }}" class="view-link">View</a>
                        <button class="join-btn">Join</button>
                    </div>
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