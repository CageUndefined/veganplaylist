@extends('layouts.page')

@section('title', 'Profile Details')

@section('page_content')
    <div class="container">
        <center>
            <b style="font-size: 30px;">
                {{ $user->name }}
            </b>
            <br>
            <small>
                Vegan Playlist Creator since {{ date('m/d/Y', strtotime($user->created_at)) }}
            </small>
        </center>
        <br>
        <br>
        
        <p>
            <b style="font-size: 18px;">Created Playlists:</b>
        </p>       
        <div class="card-columns">
           @foreach( $playlists as $playlist )
             @include('inc.playlistcard')
           @endforeach
        </div>
    </div>
@endsection