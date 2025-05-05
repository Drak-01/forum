@extends('users.layouts')

@section('content')
<div class="container">
    <h1>Paramètres du compte</h1>
    
    <div class="card mt-4">
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" class="form-control" value="{{ Auth::user()->firstName }}">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Prénom</label>
                    <input type="text" class="form-control" value="{{ Auth::user()->lastName }}">
                </div>
                
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
    </div>
</div>
@endsection