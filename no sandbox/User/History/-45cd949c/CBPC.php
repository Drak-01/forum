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

