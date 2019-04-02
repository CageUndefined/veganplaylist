@extends('layouts.page')

@section('title', $playlist->name)

@section('richmeta')
    <meta itemprop="description" content="Watch &quot;{{ $playlist->name }}&quot; and many other playlists of vegan videos on VeganPlaylist.org!">
    <meta itemprop="image" content="{{ $playlist->name }}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:url" content="{{ url('/') }}">
    <meta name="twitter:title" content="{{ $playlist->name }}">
    <meta name="twitter:description" content="Watch &quot;{{ $playlist->name }}&quot; and many other playlists of vegan videos on VeganPlaylist.org!">
    <meta name="twitter:image" content="{{ $playlist->videos[0]->getThumbnailSrcAttribute() }}">
    <meta property="og:title" content="{{ $playlist->name }}" />
    <meta property="og:name" content="{{ $playlist->name }}" />
    <meta property="og:type" content="video.other" />
    <meta property="og:site_name" content="Vegan Playlist" />
    <meta property="og:url" content="{{ route( 'playlist.show', $playlist ) }}" />
    <meta property="og:image" content="{{ $playlist->videos[0]->getThumbnailSrcAttribute() }}" />
    <meta property="og:image:alt" content="{{ $playlist->videos[0]->title }}" />
    <meta property="og:description" content="Watch &quot;{{ $playlist->name }}&quot; and many other playlists of vegan videos on VeganPlaylist.org!" />
    <meta property="og:see_also" content="{{ url('/') }}">
@endsection

@section('page_content')
	<script type="text/javascript" src="https://www.youtube.com/iframe_api"></script>
	<script src="https://player.vimeo.com/api/player.js"></script>
    <div id="viewer_app">
        <main-viewer id="main-viewer"></main-viewer>
    </div>
    <script>
        console.log(@json( $playlist ))
        const viewer = new Vue({
            el: '#viewer_app',
            data: {
                playlist: @json( $playlist ),
                index: @json( $index ),
                editUrl: @json($editUrl),
                deleteUrl: @json($deleteUrl),
                creatorProfileUrl: @json($creatorProfileUrl)
            },
            computed: {
                nonNullItems: function() {
                    return this.items.filter(function(item) {
                        return item !== null;
                    });
                }
            }
        });

        var player;
        var mainViewer = viewer.$children.find(function(c){
	  		return c.$attrs.id == "main-viewer";
	  	});

		function onYouTubeIframeAPIReady() {
			player = new YT.Player('vegan-player', {
			    events: {
			      'onStateChange': onPlayerStateChange
			    }
			});
		}
		function onPlayerStateChange(event) {
			if (event.data == 0) {
				mainViewer.moveOn();
			}
		}
        function setupContinuousPlay(){
        	var videoService = mainViewer.currentVideo.service;
        	if (videoService == 'y') {
        		if (player) onYouTubeIframeAPIReady();
        	} else if (videoService == 'v') {
    			player = new Vimeo.Player(document.querySelector('iframe#vegan-player'));
				player.on('finish', function(event) {
					onPlayerStateChange({data: 0});
				});
        	}
        }
		document.addEventListener("mainviewerready", function(){
			setupContinuousPlay();
		});
    </script>
@endsection
