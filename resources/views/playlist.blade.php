@extends('layouts.app')

@section('content')
        <div class="container-fluid">
            <div class="card">
            <div class="card-header">
                Filter Videos
            </div>
            <div class="card-body">
                <div id="filter_app"></div>
            </div>
        </div>
        <br><br>
        <div class="card-columns">
            @include('playlistcard', [ 'item_count' => 4 ])
            @include('playlistcard', [ 'item_count' => 7 ])
            @include('playlistcard', [ 'item_count' => 3 ])
            @include('playlistcard', [ 'item_count' => 4 ])
            @include('playlistcard', [ 'item_count' => 5 ])
        </div>
    </div>
@endsection
