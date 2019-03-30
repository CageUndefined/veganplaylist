@extends('layouts.page')

@section('title', $playlist->name)

@section('head')
    <meta property="og:title" content="{{ $playlist->name }}" />
    <meta property="og:type" content="video.playlist" />
    <meta property="og:site_name" content="Vegan Playlist" />
    <meta property="og:url" content="{{ $playlist->getShortURL() }}" />
    <meta property="og:image" content="{{ $playlist->videos[0]->getThumbnailSrcAttribute() }}" />
    <meta property="og:description" content="Watch {{ $playlist->name }} and many other playlists of vegan videos on VeganPlaylist.org, or create your own!" />
    <meta property="og:video:duration" content="{{ $playlist->display_duration }}" />
@endsection

@section('page_content')
	<script type="text/javascript" src="https://www.youtube.com/iframe_api"></script>
	<script src="https://player.vimeo.com/api/player.js"></script>
    <div id="viewer_app">
        <main-viewer id="main-viewer"></main-viewer>
    </div>
    <script>
        const viewer = new Vue({
            el: '#viewer_app',
            data: {
                playlist: @json( $playlist ),
                index: @json( $index ),
                editUrl: @json($editUrl),
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
