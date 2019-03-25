@extends('layouts.app')

@php
$videos = $playlist->videos;
$videoData = json_encode($playlist->videoData());
if( is_null( $video ) ) {
    $index = 0;
    $currentVideo = $videos[0];
} else {
    $index = $videos->search( function( $item, $key ) use( $video ) { return $item->is( $video ); } );
    $currentVideo = $video;
}
$totalVideos = count($videos);
$playlist['creatorName'] = $playlist->creator->name;
@endphp

@section('content')
    <div class="container">
        <div id="viewer_app">
            <main-viewer :json-playlist="'{{ $playlist }}'" :json-videodata="'{{ $videoData }}'" :initial-index="{{ $index }}"></main-viewer>
        </div>
    </div>
@endsection
