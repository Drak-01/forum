@extends('layouts.app')

@section('content')
    <div class="filter-tabs">
        <button class="filter-tab active">New</button>
        <button class="filter-tab">Top</button>
        <button class="filter-tab">Hot</button>
        <button class="filter-tab">Closed</button>
    </div>

    <div class="posts-container">
        <!-- Posts will be dynamically added here by JavaScript -->
    </div>
@endsection
