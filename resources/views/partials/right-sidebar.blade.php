<aside class="right-sidebar m-0">
    
    <section class="collectives-section">
        <div class="section-header">
            <h3>Collectives</h3>
            <a href="#" class="see-all">see all</a>
        </div>

        <div class="collectives-container">
            <div class="collectives-list" id="collectivesList">
                {{-- @foreach ($groups as $group) --}}
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
                @endforeach
            </div>
        </div>
    </section>
</aside>

<style>
    .member-badge {
        font-size: 13px;
        color: #10b981;
        font-weight: 500;
        padding: 4px 8px;
        background-color: #ecfdf5;
        border-radius: 4px;
    }

    /* Style général de la sidebar */
    .right-sidebar {
        width: 300px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-left: 20px;
    }

    /* Style des sections communes */
    .sidebar-section {
        margin-bottom: 25px;
        padding-bottom: 20px;
        border-bottom: 1px solid #f0f0f0;
    }

    .sidebar-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .sidebar-section h3 {
        font-size: 16px;
        font-weight: 600;
        color: #222;
        margin-bottom: 15px;
    }

    .sidebar-section ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-section li {
        margin-bottom: 12px;
        position: relative;
        padding-left: 15px;
    }

    .sidebar-section li:before {
        content: "•";
        position: absolute;
        left: 0;
        color: #3b82f6;
    }

    .sidebar-section a {
        color: #555;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.2s;
        display: block;
        line-height: 1.4;
    }

    .sidebar-section a:hover {
        color: #3b82f6;
    }

    /* Style spécifique pour les collectives */
    .collectives-section {
        margin-top: 25px;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .section-header h3 {
        margin: 0;
        font-size: 16px;
    }

    .see-all {
        font-size: 13px;
        color: #3b82f6;
        text-decoration: none;
        font-weight: 500;
    }

    .collectives-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .collective-card {
        background: #f8fafc;
        border-radius: 8px;
        padding: 15px;
        border: 1px solid #e2e8f0;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .collective-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .collective-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }

    .collective-icon {
        width: 36px;
        height: 36px;
        border-radius: 6px;
        background: linear-gradient(135deg, #3b82f6, #6366f1);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 13px;
        flex-shrink: 0;
    }

    .collective-title h4 {
        margin: 0;
        font-size: 15px;
        font-weight: 600;
        color: #222;
    }

    .members-count {
        font-size: 12px;
        color: #64748b;
        display: block;
        margin-top: 2px;
    }

    .collective-description {
        font-size: 13px;
        color: #555;
        line-height: 1.5;
        margin-bottom: 15px;
    }

    .collective-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .view-link {
        font-size: 13px;
        color: #3b82f6;
        text-decoration: none;
        font-weight: 500;
    }

    .join-btn {
        background: #3b82f6;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 6px 12px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.2s;
    }

    .join-btn:hover {
        background: #2563eb;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .right-sidebar {
            width: 100%;
            margin-left: 0;
            margin-top: 30px;
        }
    }

    .collectives-container {
        position: relative;
        max-height: none;
        /* Hauteur par défaut */
        overflow-y: hidden;
        /* Pas de défilement initial */
    }

    .collectives-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    /* Style quand le défilement est activé */
    .collectives-container.scroll-active {
        max-height: 500px;
        /* Hauteur maximale avant défilement */
        overflow-y: auto;
        padding-right: 8px;
        /* Espace pour la scrollbar */
    }

    /* Style de la scrollbar */
    .collectives-container.scroll-active::-webkit-scrollbar {
        width: 6px;
    }

    .collectives-container.scroll-active::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    .collectives-container.scroll-active::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 3px;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const collectivesList = document.getElementById('collectivesList');
        const container = collectivesList.parentElement;
        const maxHeightBeforeScroll = 500;
        // Vérifier la hauteur après le chargement de la page
        setTimeout(() => {
            if (collectivesList.scrollHeight > maxHeightBeforeScroll) {
                container.classList.add('scroll-active');

                // Option: Ajouter un gradient pour indiquer qu'il y a plus de contenu
                container.style.maskImage =
                    'linear-gradient(to bottom, transparent 0, black 20px, black calc(100% - 20px), transparent 100%)';
                container.style.webkitMaskImage =
                    'linear-gradient(to bottom, transparent 0, black 20px, black calc(100% - 20px), transparent 100%)';
            }
        }, 100);
    });
</script>
