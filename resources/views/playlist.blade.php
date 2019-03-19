@php    
    $playlists = App\Playlist::where( 'featured', true )->get();
@endphp

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
           @foreach( $playlists as $playlist )
             @include('playlistcard')
           @endforeach
        </div>
    </div>
@endsection
