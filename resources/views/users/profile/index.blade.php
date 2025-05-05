@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier Mon Profil</h1>

    <div class="card mt-4">
        <div class="card-body">
            <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Colonne de gauche -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Prénom</label>
                            <input type="text" name="firstName" class="form-control @error('firstName') is-invalid @enderror" 
                                   value="{{ old('firstName', Auth::user()->firstName) }}">
                            @error('firstName')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Nom</label>
                            <input type="text" name="lastName" class="form-control @error('lastName') is-invalid @enderror" 
                                   value="{{ old('lastName', Auth::user()->lastName) }}">
                            @error('lastName')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email universitaire</label>
                            <input type="email" class="form-control" value="{{ Auth::user()->univEmail }}" readonly>
                            <small class="text-muted">L'email universitaire ne peut pas être modifié</small>
                        </div>
                    </div>

                    <!-- Colonne de droite -->
                    <div class="col-md-6">
                        <div class="mb-3 text-center">
                            <label class="form-label d-block">Photo de profil</label>
                            <div class="mb-2">
                                @if(Auth::user()->userPicture)
                                    <img src="{{ asset('storage/' . Auth::user()->userPicture) }}" 
                                         class="rounded-circle img-thumbnail" 
                                         width="150" height="150" 
                                         alt="Photo de profil" id="previewImage">
                                @else
                                    <div class="rounded-circle bg-secondary d-inline-flex align-items-center justify-content-center" 
                                         style="width: 150px; height: 150px;">
                                        <span class="text-white fs-1">{{ strtoupper(substr(Auth::user()->firstName, 0, 1)) }}</span>
                                    </div>
                                @endif
                            </div>
                            <input type="file" name="userPicture" class="form-control @error('userPicture') is-invalid @enderror" 
                                   id="imageUpload" accept="image/*">
                            @error('userPicture')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                           placeholder="Laissez vide pour ne pas modifier">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirmation du mot de passe</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    <a href="{{ route('user.questions.index') }}" class="btn btn-outline-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Prévisualisation de l'image avant upload
    document.getElementById('imageUpload').addEventListener('change', function(e) {
        const previewImage = document.getElementById('previewImage');
        const file = e.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
            }
            
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection