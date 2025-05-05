@extends('layouts.app')

@section('content')
<div class="container py-4 w-100">
    <div class="row justify-content-center">
        <div class="col-md">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-people-fill me-2"></i>Créer un nouveau groupe</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('user.user.groups.creer') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Nom du groupe -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom du groupe <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Un nom unique qui identifiera votre groupe</small>
                        </div>

                        <!-- Image du groupe -->
                        <div class="mb-3">
                            <label for="groupPicture" class="form-label">Image du groupe</label>
                            <input type="file" class="form-control @error('groupPicture') is-invalid @enderror" 
                                   id="groupPicture" name="groupPicture" accept="image/*">
                            @error('groupPicture')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="mt-2">
                                <img id="imagePreview" src="#" alt="Aperçu de l'image" 
                                     class="img-thumbnail d-none" style="max-width: 200px; max-height: 200px;">
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('user.user.groups') }}" class="btn btn-outline-secondary me-md-2">
                                <i class="bi bi-arrow-left"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Créer le groupe
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('groupPicture').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        const file = e.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            }
            
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('d-none');
        }
    });
</script>
@endpush
@endsection