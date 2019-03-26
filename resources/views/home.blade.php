@extends('layouts.page')

@section('page_content')
    <div class="container">
		<center>
        <b style="    font-size: 30px;">Find and share inspirational vegan videos</b><br>
		<b style="    font-size: 18px;">Spread the compassionate vegan message with our curated playlists, or create your own from our huge video library.</b><br><br>
	
	
	<form action="{{ route( 'playlist.create' ) }}" method="get">
				
	<div class="input-group mb-3" style="width: 20rem;">
	<input class="form-control" style="padding: 6px;" name="name" placeholder="Enter a playlist name to start" />
	<div class="input-group-append">
	<button class="btn btn-outline-secondary" style="background-color: #349de4;color: #fff;"type="button" id="button-addon2">Create</button>
	</div>
	</div>

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
