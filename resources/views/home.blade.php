@extends('layouts.page')

@php for( $i = 0; $i < 10; $i++ ) $playlists[] = $playlists[ 0 ]; @endphp

@section('page_content')
    <div class="container">
		<center>
        <b style="    font-size: 30px;">Find and share inspirational vegan videos</b><br>
		<b style="    font-size: 18px;">Spread the compassionate vegan message with our curated playlists, or create your own from our huge video library.</b><br><br>
			 <form action="{{ route( 'playlist.create' ) }}" method="get">
                        <input style="    width: 273px;
    padding: 6px;"name="name" placeholder="Enter a playlist name to start" />
                        <button class="btn btn-primary">Create</button>
                    </form>
       </center>
        <br><br>
        <div class="card-columns">
           @foreach( $playlists as $playlist )
             @include('inc.playlistcard')
           @endforeach
        </div>
    </div>
@endsection
