@extends('users.groups.group-show')

@section('content-group')
<div class="card">
    <div class="card-header">
        Membres du groupe ({{ $group->members->count() }})
    </div>
    <div class="card-body">
        <div class="list-group">
            @foreach($group->members as $member)
                <div class="list-group-item d-flex align-items-center">
                    <img src="{{ $member->userPicture ? asset('storage/'.$member->userPicture) : 'https://i.pravatar.cc/40?img='.$member->id }}" 
                        class="rounded-circle me-2" width="30" height="30">
                    <span>{{ $member->username }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection