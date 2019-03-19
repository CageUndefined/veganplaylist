@extends('layouts.app')

@php
$videos = $playlist->videos;
$index = $videos->search( function( $item, $key ) use( $video ) { return $item->id == $video->id; } );
$totalVideos = count($videos);
$previousVideo = $index > 0 ? $videos[$index - 1] : null;
$nextVideo = $index < ($totalVideos - 1) ? $videos[$index + 1] : null;
$currentVideo = $video;
@endphp

@section('content')
    <div class="container">
    	<div class="row mb-1">
    		<div class="col-md-9">
				{{ $playlist->name }}
				<br>
				Created by {{ $playlist->creator->name }}
			</div>
    		<div class="col-md-3">PLAYLIST STATS</div>
    	</div>
    	<div class="row mb-2">
    		<div class="col-md-9">{{ $currentVideo['title'] }}</div>
    		<div class="col-md-3">{{ $index + 1 }}/{{ $totalVideos }}</div>
    	</div>
    	<div class="row mb-3">
    		<div class="col-md-3">
    			@include("inc.link", ['video' => $previousVideo, 'index' => ($index - 1)])
    		</div>
    		<div class="col-md-6">
    			@include("inc.embed", ['video' => $currentVideo ])
    		</div>
    		<div class="col-md-3">
    			@include("inc.link", ['video' => $nextVideo, 'index' => ($index + 1)])
    		</div>
    	</div>
    	<div class="playlist-scroller">
    		@if ($previousVideo)
    			<a href="{{ route( 'playlist.video.show', [ $playlist, $previousVideo ] ) }}" class="playlist-scroller__nav--previous">Prev</a>
    		@else
    			<a href="#" class="playlist-scroller__nav--previous playlist-scroller__nav--disabled">Prev</a>
    		@endif
    		<?php $i = 0 ?>
			@foreach ($videos as $video)
				@include("inc.playlistitem", ['video' => $video, 'index' => $i, 'active' => ($i == $index)])
				<?php $i++ ?>
			@endforeach
    		@if ($nextVideo)
    			<a href="{{ route( 'playlist.video.show', [ $playlist, $nextVideo ] ) }}" class="playlist-scroller__nav--next">Next</a>
    		@else
    			<a href="#" class="playlist-scroller__nav--next playlist-scroller__nav--disabled">Next</a>
    		@endif
		</div>
    </div>
@endsection
