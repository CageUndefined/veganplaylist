@extends('layouts.page')

@section('title', 'Profile Details')

@section('page_content')
    <div class="container">
        <center>
            <b style="font-size: 30px;">
                Playlists created by {{ $user->name }}
            </b>
			<br>
			<b style="font-size: 18px;">View and share the below curated playlists by {{ $user->name }} since {{ date('m/d/Y', strtotime($user->created_at)) }}!</b>
			<br>
        </center>
        <br>
        <br>
             
        <div class="card-columns">
           @foreach( $playlists as $playlist )
             @include('inc.playlistcard')
           @endforeach
        </div>
    </div>
@endsection