{{-- @extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Poser une nouvelle question</h1>

            <form action="{{ route('user.questions.store') }}" method="POST">
                @csrf

                <!-- Titre de la question -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Titre de la question</label>
                    <input type="text" id="title" name="title" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Quelle est votre question ?">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Contenu de la question -->
                <div class="mb-6">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Détails de la
                        question</label>
                    <textarea id="content" name="content" rows="8" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Décrivez votre question en détails..."></textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Type de contenu -->
                <div class="mb-6">
                    <label for="contentType" class="block text-sm font-medium text-gray-700 mb-2">Type de question</label>
                    <select id="contentType" name="contentType" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Sélectionnez un type</option>
                        <option value="question">Question générale</option>
                        <option value="help">Demande d'aide</option>
                        <option value="discussion">Discussion</option>
                    </select>
                    @error('contentType')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sélection des tags -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                    <div class="flex flex-wrap gap-2 mb-2" id="selected-tags-container">
                        <!-- Les tags sélectionnés apparaîtront ici -->
                    </div>

                    <div class="relative">
                        <input type="text" id="tag-search"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Rechercher ou ajouter des tags...">
                        <div id="tag-suggestions"
                            class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg hidden max-h-60 overflow-y-auto">
                        </div>
                    </div>

                    <!-- Champ caché pour stocker les tags sélectionnés -->
                    <input type="hidden" name="tags" id="selected-tags">

                    <p class="mt-2 text-sm text-gray-500">Sélectionnez jusqu'à 5 tags pertinents pour votre question.</p>
                    @error('tags')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Groupe (optionnel) -->
                <div class="mb-6">
                    <label for="group_id" class="block text-sm font-medium text-gray-700 mb-2">Groupe (optionnel)</label>
                    <select id="group_id" name="group_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Aucun groupe</option>
                        @foreach ($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Bouton de soumission -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Publier la question
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script pour la gestion des tags -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tagSearch = document.getElementById('tag-search');
            const tagSuggestions = document.getElementById('tag-suggestions');
            const selectedTagsContainer = document.getElementById('selected-tags-container');
            const selectedTagsInput = document.getElementById('selected-tags');
            let selectedTags = [];

            // Écouteur pour la recherche de tags
            tagSearch.addEventListener('input', function() {
                const query = this.value.trim();

                if (query.length < 2) {
                    tagSuggestions.classList.add('hidden');
                    return;
                }

                // Requête AJAX pour rechercher des tags
                fetch(`/tags/search?q=${query}`)
                    .then(response => response.json())
                    .then(tags => {
                        if (tags.length > 0) {
                            tagSuggestions.innerHTML = '';
                            tags.forEach(tag => {
                                // Vérifier si le tag est déjà sélectionné
                                const isSelected = selectedTags.some(t => t.id === tag.id);

                                if (!isSelected) {
                                    const tagElement = document.createElement('div');
                                    tagElement.className =
                                        'px-4 py-2 hover:bg-gray-100 cursor-pointer flex justify-between items-center';
                                    tagElement.innerHTML = `
                                <span class="inline-block px-2 py-1 rounded-full text-xs font-medium" style="background-color: ${tag.color}; color: white;">
                                    ${tag.name}
                                </span>
                                <span class="text-xs text-gray-500">Cliquez pour ajouter</span>
                            `;
                                    tagElement.addEventListener('click', () => addTag(tag));
                                    tagSuggestions.appendChild(tagElement);
                                }
                            });

                            // Option pour créer un nouveau tag
                            const createTagElement = document.createElement('div');
                            createTagElement.className =
                                'px-4 py-2 hover:bg-gray-100 cursor-pointer bg-gray-50 border-t border-gray-200';
                            createTagElement.innerHTML = `
                        <span class="text-blue-600">Créer un nouveau tag: "${query}"</span>
                    `;
                            createTagElement.addEventListener('click', () => {
                                createNewTag(query);
                            });
                            tagSuggestions.appendChild(createTagElement);

                            tagSuggestions.classList.remove('hidden');
                        } else {
                            // Aucun tag trouvé - option pour créer un nouveau
                            tagSuggestions.innerHTML = '';
                            const createTagElement = document.createElement('div');
                            createTagElement.className =
                                'px-4 py-2 hover:bg-gray-100 cursor-pointer bg-gray-50';
                            createTagElement.innerHTML = `
                        <span class="text-blue-600">Créer un nouveau tag: "${query}"</span>
                    `;
                            createTagElement.addEventListener('click', () => {
                                createNewTag(query);
                            });
                            tagSuggestions.appendChild(createTagElement);
                            tagSuggestions.classList.remove('hidden');
                        }
                    });
            });

            // Ajouter un tag sélectionné
            function addTag(tag) {
                if (selectedTags.length >= 5) {
                    alert('Vous ne pouvez sélectionner que 5 tags maximum.');
                    return;
                }

                if (!selectedTags.some(t => t.id === tag.id)) {
                    selectedTags.push(tag);
                    updateSelectedTags();
                    tagSearch.value = '';
                    tagSuggestions.classList.add('hidden');
                }
            }

            // Créer un nouveau tag
            function createNewTag(name) {
                if (selectedTags.length >= 5) {
                    alert('Vous ne pouvez sélectionner que 5 tags maximum.');
                    return;
                }

                fetch('/tags', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            name
                        })
                    })
                    .then(response => response.json())
                    .then(tag => {
                        addTag(tag);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }

            // Mettre à jour l'affichage des tags sélectionnés
            function updateSelectedTags() {
                selectedTagsContainer.innerHTML = '';
                const tagIds = [];

                selectedTags.forEach(tag => {
                    const tagElement = document.createElement('span');
                    tagElement.className =
                        'inline-flex items-center px-2 py-1 rounded-full text-xs font-medium mr-2 mb-2';
                    tagElement.style.backgroundColor = tag.color;
                    tagElement.style.color = 'white';
                    tagElement.innerHTML = `
                ${tag.name}
                <button type="button" data-tag-id="${tag.id}" class="ml-1 text-white hover:text-gray-200">
                    &times;
                </button>
            `;
                    selectedTagsContainer.appendChild(tagElement);
                    tagIds.push(tag.id);
                });

                // Mettre à jour le champ caché avec les IDs des tags sélectionnés
                selectedTagsInput.value = JSON.stringify(tagIds);
            }

            // Supprimer un tag sélectionné
            selectedTagsContainer.addEventListener('click', function(e) {
                if (e.target.tagName === 'BUTTON') {
                    const tagId = parseInt(e.target.getAttribute('data-tag-id'));
                    selectedTags = selectedTags.filter(tag => tag.id !== tagId);
                    updateSelectedTags();
                }
            });

            // Cacher les suggestions quand on clique ailleurs
            document.addEventListener('click', function(e) {
                if (!tagSearch.contains(e.target) && !tagSuggestions.contains(e.target)) {
                    tagSuggestions.classList.add('hidden');
                }
            });
        });
    </script>
@endsection --}}
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="mx-auto bg-white p-4 rounded shadow-sm" style="max-width: 720px;">
        <h1 class="h4 fw-bold text-primary mb-4">Poser une nouvelle question</h1>

        <form action="{{ route('user.questions.store') }}" method="POST">
            @csrf

            {{-- Titre --}}
            <div class="mb-3">
                <label for="title" class="form-label">Titre de la question</label>
                <input type="text" id="title" name="title" required class="form-control @error('title') is-invalid @enderror"
                    placeholder="Quelle est votre question ?">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Contenu --}}
            <div class="mb-3">
                <label for="content" class="form-label">Détails de la question</label>
                <textarea id="content" name="content" rows="6" required
                    class="form-control @error('content') is-invalid @enderror"
                    placeholder="Décrivez votre question en détails..."></textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Type de question --}}
            <div class="mb-3">
                <label for="contentType" class="form-label">Type de question</label>
                <select id="contentType" name="contentType" class="form-select @error('contentType') is-invalid @enderror" required>
                    <option value="">Sélectionnez un type</option>
                    <option value="question">Question générale</option>
                    <option value="help">Demande d'aide</option>
                    <option value="discussion">Discussion</option>
                </select>
                @error('contentType')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tags --}}
            <div class="mb-3">
                <label class="form-label">Tags</label>
                <div class="d-flex flex-wrap gap-2 mb-2" id="selected-tags-container">
                    {{-- Tags sélectionnés --}}
                </div>

                <input type="text" id="tag-search" class="form-control mb-2" placeholder="Rechercher ou ajouter des tags...">
                <div id="tag-suggestions" class="list-group position-absolute z-3 w-100 d-none" style="max-height: 200px; overflow-y: auto;"></div>
                <input type="hidden" name="tags" id="selected-tags">
                <div class="form-text">Sélectionnez jusqu'à 5 tags pertinents.</div>

                @error('tags')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            {{-- Groupe --}}
            <div class="mb-3">
                <label for="group_id" class="form-label">Groupe (optionnel)</label>
                <select id="group_id" name="group_id" class="form-select">
                    <option value="">Aucun groupe</option>
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Bouton --}}
            <div class="text-end">
                <button type="submit" class="btn btn-primary">
                    Publier la question
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script tags Bootstrap --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tagSearch = document.getElementById('tag-search');
        const tagSuggestions = document.getElementById('tag-suggestions');
        const selectedTagsContainer = document.getElementById('selected-tags-container');
        const selectedTagsInput = document.getElementById('selected-tags');
        let selectedTags = [];

        tagSearch.addEventListener('input', function () {
            const query = this.value.trim();
            if (query.length < 2) {
                tagSuggestions.classList.add('d-none');
                return;
            }

            fetch(`/tags/search?q=${query}`)
                .then(response => response.json())
                .then(tags => {
                    tagSuggestions.innerHTML = '';
                    tags.forEach(tag => {
                        if (!selectedTags.some(t => t.id === tag.id)) {
                            const item = document.createElement('button');
                            item.type = 'button';
                            item.className = 'list-group-item list-group-item-action';
                            item.textContent = tag.name;
                            item.onclick = () => addTag(tag);
                            tagSuggestions.appendChild(item);
                        }
                    });

                    // Ajout bouton créer un nouveau tag
                    const createTagBtn = document.createElement('button');
                    createTagBtn.type = 'button';
                    createTagBtn.className = 'list-group-item list-group-item-action text-primary';
                    createTagBtn.textContent = `Créer un nouveau tag: "${query}"`;
                    createTagBtn.onclick = () => createNewTag(query);
                    tagSuggestions.appendChild(createTagBtn);

                    tagSuggestions.classList.remove('d-none');
                });
        });

        function addTag(tag) {
            if (selectedTags.length >= 5) {
                alert('Maximum 5 tags.');
                return;
            }

            selectedTags.push(tag);
            updateSelectedTags();
            tagSearch.value = '';
            tagSuggestions.classList.add('d-none');
        }

        function createNewTag(name) {
            if (selectedTags.length >= 5) {
                alert('Maximum 5 tags.');
                return;
            }

            fetch('/tags', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ name })
            })
            .then(response => response.json())
            .then(tag => {
                addTag(tag);
            });
        }

        function updateSelectedTags() {
            selectedTagsContainer.innerHTML = '';
            const tagIds = [];

            selectedTags.forEach(tag => {
                const span = document.createElement('span');
                span.className = 'badge bg-primary me-2 mb-2';
                span.innerHTML = `${tag.name} <button type="button" class="btn-close btn-close-white btn-sm ms-2" data-tag-id="${tag.id}"></button>`;
                selectedTagsContainer.appendChild(span);
                tagIds.push(tag.id);
            });

            selectedTagsInput.value = JSON.stringify(tagIds);
        }

        selectedTagsContainer.addEventListener('click', function (e) {
            if (e.target.classList.contains('btn-close')) {
                const tagId = parseInt(e.target.dataset.tagId);
                selectedTags = selectedTags.filter(tag => tag.id !== tagId);
                updateSelectedTags();
            }
        });

        document.addEventListener('click', function (e) {
            if (!tagSearch.contains(e.target) && !tagSuggestions.contains(e.target)) {
                tagSuggestions.classList.add('d-none');
            }
        });
    });
</script>
@endsection
