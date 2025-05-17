@extends('users.profile.activite')

@section('content-Activites')
    <div class="d-flex align-items-center mb-4">
        <h1 class="mb-0">
            {{ $total }}
        </h1>
        <span class="h4 text-muted ms-2">Reponses</span>
    </div>
    <div class="posts-container">
        @foreach($reponses as $reponse)
            <div class="post-card">
                <div class="post-header">
                         <img src="{{ $reponse->user->userPicture 
                         ? asset('storage/' . $reponse->user->userPicture) 
                         : 'https://i.pravatar.cc/40?img=' . $reponse->user->id }}" 
                 alt="Avatar de {{ $reponse->user->username }}" 
                 class="avatar">
            
                    <div>
                        <strong>{{ $reponse->user->username }}</strong>
                        <small>{{ $reponse->datePost() }}</small>
                    </div>
                </div>
                
                <a href="{{ route('user.reponses.show', $reponse) }}" class="post-title">
                    {{ $reponse->question->title }}
                </a>
                
                <p class="post-content">{{ Str::limit($reponse->content, 150) }}</p>           
            </div>
            <div class="post-footer">
                <span>👁️ {{ rand(50, 200) }}</span>
                <span>💬 {{ $reponses->count() }}</span>
                <span>⬆️ {{ $reponses->sum(function($reponse) { return $reponse->votes->sum('nbreVote'); }) }}</span>
            </div>
        @endforeach

        @if($reponses instanceof \Illuminate\Pagination\AbstractPaginator)
            {{ $reponses->links() }}
        @endif
    </div>
@endsection