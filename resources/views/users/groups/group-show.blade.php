@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ $group->name }}</h4>
        </div>

        <div class="card-body" style="height: 400px; overflow-y: auto;">
            @forelse ($messages as $message)
                <div class="mb-2">
                    <strong>{{ $message->user->username }}:</strong> {{ $message->content }}
                    <small class="text-muted float-end">{{ $message->created_at->diffForHumans() }}</small>
                </div>
            @empty
                <p class="text-muted">Aucun message pour le moment.</p>
            @endforelse
        </div>

        <div class="card-footer">
           <form action="{{ route('user.groups.messages.store', $group->id) }}" method="POST">

                @csrf
                <div class="input-group">
                    <input type="text" name="content" class="form-control" placeholder="Écrire un message..." required>
                    <button class="btn btn-primary" type="submit">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
