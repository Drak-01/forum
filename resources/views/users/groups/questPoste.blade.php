@extends('users.groups.group-show')

@section('content-group')
<div class="container py-5">
    <div class="mx-auto bg-white p-4 rounded shadow-sm" style="max-width: 720px;">
    
        <form action="{{ route('user.group.questions.store', $group->id) }}" method="POST">
            @csrf
            <input type="hidden" name="contentType" value="question">
            <!-- Titre -->
            <div class="mb-3">
                <label for="title" class="form-label">Titre *</label>
                <input type="text" id="title" name="title" required 
                       class="form-control @error('title') is-invalid @enderror"
                       placeholder="Quelle est votre question ?"
                       value="{{ old('title') }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Contenu -->
            <div class="mb-3">
                <label for="content" class="form-label">Détails *</label>
                <textarea id="content" name="content" rows="6" required
                    class="form-control @error('content') is-invalid @enderror"
                    placeholder="Décrivez votre question en détails...">{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tags -->
            <div class="mb-3 position-relative">
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

            <!-- Boutons -->
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane me-1"></i> Publier
                </button>
            </div>
        </form>
    </div>
</div>

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