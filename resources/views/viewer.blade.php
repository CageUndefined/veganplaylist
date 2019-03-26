@extends('layouts.page')

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

@section('page_content')
    <div id="viewer_app">
        <main-viewer></main-viewer>
    </div>
    <script>

        const viewer = new Vue({
            el: '#viewer_app',
            data: {
                playlist: @json( $playlist ),
                index: @json( $index )
            },
            computed: {
                nonNullItems: function() {
                    return this.items.filter(function(item) {
                        return item !== null;
                    });
                }
            }
         });

    </script>
@endsection
