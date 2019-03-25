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
    		<a href="#" v-show="index > 0" v-on:click="changeIndex(index - 1)" class="playlist-scroller__nav--previous">
				&larr;
    		</a>
    		<span v-for="(video, i) in videos">
				<a href="#" v-on:click="changeIndex(i)" :class="video.linkClass">
					<img :src="video.thumbnailSrc" class="img-fluid img-thumbnail" alt="">
				</a>
    		</span>
    		<a href="#" v-show="index < (videos.length - 1)" v-on:click="changeIndex(index + 1)" class="playlist-scroller__nav--next playlist-scroller__nav--disabled">
				&rarr;
    		</a>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['jsonPlaylist', 'jsonVideodata', 'initialIndex'],
		data: function () {
			return {
				playlist: JSON.parse(this.jsonPlaylist),
				videos: JSON.parse(this.jsonVideodata),
				index: parseInt(this.initialIndex)
			}
		},
		methods: {
			init: function() {
				var videos = this.videos;
				var index = this.index;

				var current = videos[index];
				current.iframeClass = 'embed__aspect-ratio embed__aspect-ratio--' + (current.widescreen ? '16by9' : '4by3');
				current.iframeBackgroundImg = current.thumbnailSrc;

				for (var i = 0; i < videos.length; i++){
					var video = videos[i];
					video.active = i == index;
					video.linkClass = 'playlist-scroller__item' +  (video.active ? ' playlist-scroller__item--active' : '');
				}

				this.currentVideo = current;
			},
			changeIndex: function(i){
				this.index = i;
				this.init();
			}
		},
		created: function() {
			this.init();
		},
		updated: function () {
			this.init();
		}
	}
</script>
