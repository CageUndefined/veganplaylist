@extends('layouts.app')

@php
$videos = $playlist->videos;

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
    <div id="viewer_app">
        <main-viewer :json-playlist="'{{ $playlist }}'" :initial-index="{{ $index }}"></main-viewer>
    </div>
@endsection
