<template>
	<div>	
		<div class="row mb-1 playlist-heading">
			<div class="col-md-9">
				<span class="playlist-heading__title">
					{{ playlist.name }}
				</span>
				<br>
				Created by 
				<span class="playlist-heading__creator">
					{{ playlist.creatorName }}
				</span>
			</div>
			<div class="col-md-3">PLAYLIST STATS</div>
		</div>
		<div class="current-video">
	    	<div class="row mb-2 current-video__title">
	    		<div class="col-md-9">{{ currentVideo.title }}</div>
	    		<div class="col-md-3">{{ (index + 1) }}/{{ videos.length }}</div>
	    	</div>
			<div class="embed current-video__embed mb-2">
				<div :class="currentVideo.iframeClass">
					<iframe class="embed__iframe" :src="currentVideo.src"></iframe>
				</div>
			</div>
		</div>
    	<div class="playlist-scroller">
    		<a href="#" v-show="index != 0" v-on:click="changeIndex(index - 1)" class="playlist-scroller__nav--previous">
				&larr;
    		</a>
    		<span v-for="(video, i) in videos">
				<a href="#" v-on:click="changeIndex(i)" :class="video.linkClass">
					<img :src="video.thumbnailSrc" class="img-fluid img-thumbnail" alt="">
				</a>
    		</span>
    		<a href="#" v-show="index != (videos.length - 1)" v-on:click="changeIndex(index + 1)" class="playlist-scroller__nav--next playlist-scroller__nav--disabled">
				&rarr;
    		</a>
		</div>
	</div>
</template>

<script>

	function getLinkClassAttribute(video, index) {
		return 'playlist-scroller__item' +  (video.active ? ' playlist-scroller__item--active' : '');
	}

	function getIframeClassAttribute(video) {
		return 'embed__aspect-ratio embed__aspect-ratio--' + (video.widescreen ? '16by9' : '4by3');
	}

	function getEmbedSrcAttribute(video) {
		switch (video.service) {
			case 'y':
			return "https://invidio.us/embed/" + video.service_video_id;
			case 'v':
			return "https://player.vimeo.com/video/" + video.service_video_id;
			default:
			throw new Exception("Service char out of range: '" + video.service + "'..!", 1);
		}
	}

	function getThumbnailSrcAttribute(video) {
		switch (video.service) {
			case 'y':
			return "https://img.youtube.com/vi/" + video.service_video_id + "/hqdefault.jpg";
			case 'v':
			return "";
			// var url = 'https://vimeo.com/api/oembed.json?url=https://vimeo.com/';
			// var json = json_decode(file_get_contents($url + video.service_video_id));
			return json.thumbnail_url;
			default:
			throw new Exception("Service char out of range: '" + video.service + "'..!", 1);
		}
	}

	export default {
		props: ['playlist', 'initialIndex'],
		data: function () {
			var playlist = JSON.parse(this.playlist);
			return {
				videos: playlist.videos,
				index: 0
			}
		},
		methods: {
			init: function() {
				var videos = this.videos;
				var index = this.index;

				var current = videos[index];
				current.iframeClass = getIframeClassAttribute(current);
				current.iframeBackgroundImg = getThumbnailSrcAttribute(current);
				current.src = getEmbedSrcAttribute(current);

				var totalVideos = videos.length;
				
				var previous = index > 0 ? videos[index - 1] : null;
				if (previous !== null)
					previous.thumbnailSrc = getThumbnailSrcAttribute(previous);

				var next = index < (totalVideos - 1) ? videos[index + 1] : null;
				if (next !== null)
					next.thumbnailSrc = getThumbnailSrcAttribute(next);

				for (var i = 0; i < totalVideos; i++){
					var video = videos[i];
					video.active = i == index;
					video.linkClass = getLinkClassAttribute(video, i);
					video.thumbnailSrc = getThumbnailSrcAttribute(video);
				}
				this.currentVideo = current;
				this.nextVideo = next;
				this.previousVideo = previous;
			},
			changeIndex: function(index){
				this.index = index;
				this.init();
			}
		},
		created: function() {
			this.init();
		}
	}
</script>
