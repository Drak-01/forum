{{-- <aside class="right-sidebar">
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
</aside> --}}
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


    {{-- <section class="collectives-section">
        <div class="section-header">
            <h3>Collectives</h3>
            <a href="#" class="see-all">see all</a>
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
                        <a href="#"  class="view-link">View</a>
                        @if(Auth::check())
                            @if(!$group->users->contains(Auth::id()))
                                <button class="join-btn">Join</button>
                            @else
                                <span class="member-badge">Member</span>
                            @endif
                        @else
                            <button class="join-btn">Join</button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section> --}}
    
    Voici comment transformer l'affichage en défilement vertical avec une hauteur fixe :

```html
<section class="collectives-section">
    <div class="section-header">
        <h3>Collectives</h3>
        <a href="{{ route('groups.index') }}" class="see-all">see all</a>
    </div>
    
    <!-- Conteneur avec hauteur fixe et défilement vertical -->
    <div class="collectives-vertical-container">
        <div class="collectives-vertical-wrapper">
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
                        @if(Auth::check())
                            @if(!$group->users->contains(Auth::id()))
                                <button class="join-btn">Join</button>
                            @else
                                <span class="member-badge">Member</span>
                            @endif
                        @else
                            <button class="join-btn">Join</button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    .collectives-section {
        margin: 20px 0;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .collectives-vertical-container {
        height: 500px; /* Hauteur fixe */
        overflow-y: auto;
        padding-right: 10px; /* Espace pour la scrollbar */
        border-radius: 8px;
        background: #f8f9fa;
        border: 1px solid #eaeaea;
    }

    .collectives-vertical-wrapper {
        display: flex;
        flex-direction: column;
        gap: 15px;
        padding: 10px;
    }

    .collective-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        padding: 15px;
        transition: transform 0.2s;
    }

    .collective-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    /* Style de la scrollbar verticale */
    .collectives-vertical-container::-webkit-scrollbar {
        width: 8px;
    }

    .collectives-vertical-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .collectives-vertical-container::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    .collectives-vertical-container::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* Styles existants pour le contenu des cartes */
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
        font-size: 14px;
    }
    
    .collective-title h4 {
        margin: 0;
        font-size: 16px;
        color: #222;
    }
    
    .members-count {
        font-size: 12px;
        color: #64748b;
    }
    
    /* ... autres styles existants ... */
</style>
```

### Fonctionnalités clés :

1. **Défilement vertical** :
   - Hauteur fixe de 500px pour le conteneur
   - Défilement automatique quand le contenu dépasse
   - Scrollbar stylisée

2. **Affichage des cartes** :
   - Chaque carte prend toute la largeur
   - Espacement vertical de 15px entre les cartes
   - Effet de survol sur les cartes

3. **Avantages** :
   - Plus naturel pour les listes longues
   - Meilleure utilisation de l'espace sur mobile
   - Plus accessible (meilleure navigation au clavier)

4. **Personnalisation** :
   - Ajustez la hauteur (500px) selon vos besoins
   - Modifiez le gap (15px) pour l'espacement
   - Changez les couleurs de la scrollbar

### Version avec "Voir plus" après 3 cartes :

```html
<div class="collectives-vertical-container">
    <div class="collectives-vertical-wrapper">
        @foreach($groups->take(3) as $group)
            @include('partials.group-card', ['group' => $group])
        @endforeach
        
        @if($groups->count() > 3)
            <div class="show-more-container">
                <button class="show-more-btn">
                    Voir les {{ $groups->count() - 3 }} autres collectives
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M6 9l6 6 6-6"/>
                    </svg>
                </button>
            </div>
            
            <div class="hidden-collectives" style="display: none;">
                @foreach($groups->slice(3) as $group)
                    @include('partials.group-card', ['group' => $group])
                @endforeach
            </div>
        @endif
    </div>
</div>

<style>
    .show-more-container {
        text-align: center;
        margin: 10px 0;
    }
    
    .show-more-btn {
        background: none;
        border: none;
        color: #3b82f6;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-weight: 500;
    }
    
    .show-more-btn:hover {
        text-decoration: underline;
    }
</style>

<script>
document.querySelector('.show-more-btn')?.addEventListener('click', function() {
    document.querySelector('.hidden-collectives').style.display = 'block';
    this.parentElement.style.display = 'none';
});
</script>
```
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
</style>