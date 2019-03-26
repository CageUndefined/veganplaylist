<template>
	<div class="viewer">
		<div class="heading">
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<h4>
							{{ playlist.name }}
							<small v-if="playlist.creator">
								Created by <em>{{ playlist.creator.name }}</em>
							</small>
						</h4>
					</div>
					<div class="col-md-3">
						views: {{ playlist.views }}
						videos: {{ playlist.videos.length }}
						length: 1 hour
					</div>
				</div>
			</div>
		</div>
		<div class="subheading">
			<div class="container">
				<h5>
		    		<a href="#" v-show="index > 0" v-on:click="changeIndex(index - 1)">
						&larr;
		    		</a>
		    		{{ currentVideo.title }}
					<small>
		    			({{ (index + 1) }} / {{ playlist.videos.length }})
		    		</small>
		    		<a href="#" v-show="index < (playlist.videos.length - 1)" v-on:click="changeIndex(index + 1)">
						&rarr;
		    		</a>
				</h5>
	    	</div>
		</div>
		<div class="embed">
			<iframe class="embed__iframe" :src="currentVideo.src"></iframe>
		</div>
    	<div class="navigation">
    		<div class="container">
				<a href="#"
					v-for="(video, i) in playlist.videos"
					v-on:click="changeIndex(i)"
					:title="video.title"
					:class="video.linkClass">
					<img :src="video.thumbnailSrc" alt="">
				</a>
    		</div>
		</div>
	</div>
</template>

<script>
	export default {
		data: function () {
			return {
				playlist: this.$parent.playlist,
				index: this.$parent.index
			}
		},
		methods: {
			init: function() {
				var videos = this.playlist.videos;
				var index = this.index;

				var current = videos[index];
				current.iframeClass = 'embed__aspect-ratio embed__aspect-ratio--' + (current.widescreen ? '16by9' : '4by3');
				current.iframeBackgroundImg = current.thumbnailSrc;

				for (var i = 0; i < videos.length; i++){
					var video = videos[i];
					video.active = i == index;
					video.linkClass = (video.active ? 'active' : '');
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
