@extends('layouts.app')

@section('content')
    <div class="container">
    @if (!empty($user))
    
        <h3>Profile Details</h3>
        <ul>
            <li>Name: {{ $user->name }}</li>
            <li>Vegan Playlist Creator since: {{ date('m/d/Y', strtotime($user->created_at)) }}</li>
        </ul>

        <h3>Playlists</h3>
        <ol>                
        @foreach( $playlists as $playlist )
            <li>
                <strong>{{ $playlist->name }}</strong><br>
                Created: {{ date('m/d/Y', strtotime($playlist->created_at)) }} <br>
                Viewed: {{ $playlist->views }} times
            </li>
        @endforeach
        </ol>
    @else
        The profile was not found!
    @endif
    </div>
@endsection
