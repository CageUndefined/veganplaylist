<template>
  <div class="viewer">
    <div class="heading">
      <div class="container">
        <div class="row">
          <div class="title col-md-8">
            <h5><i class="fas fa-play-circle"></i> {{ playlist.name }}: {{ currentVideo.title }}</h5>
          </div>
          <div class="stats col-md-4 row">
          	<div class="col-md-3">
          		playlist
          		<br>
          		{{ (index + 1) }} / {{ playlist.videos.length }}
          	</div>
            <div class="col-md-3">
              views
              <br>
              {{ playlist.views }}
            </div>
            <div class="col-md-3">
              videos
              <br>
              {{ playlist.videos.length }}
            </div>
            <div class="col-md-3">
              run time
              <br>
              {{ playlist.display_length }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="embed">
      <iframe id="vegan-player" class="embed__iframe" enablejsapi=true :src="currentVideo.src"></iframe>
    </div>
    <div class="navigation row">
      <div class="col-md-2">
        <a v-if="editUrl" :href="editUrl"><i class="fas fa-edit"></i> Edit playlist</a>
        <a v-if="deleteUrl" v-on:click="deletePlaylist(playlist)" href="#" class="ml-4"><i class="fas fa-trash"></i> Delete playlist</a>
      </div>
      <div class="container col-md-8 row">
        <div class="col-md-1">
          <a class="arrow" href="#" v-show="index > 0" v-on:click="changeIndex(index - 1)"><i class="fas fa-arrow-left"></i></a>
        </div>
        <div class="thumbnail-strip col-md-10">
          <a
            class="thumbnail"
            href="#"
            v-for="(video, i) in pageVideos"
            v-bind:key="i"
            v-on:click="selectVideo(i)"
            :title="video.title"
            :class="video.linkClass"
          >
            <img :src="video.thumbnailSrc" alt>
          </a>
        </div>
        <div class="col-md-1 next">
          <a
            class="arrow"
            href="#"
            v-show="index < (playlist.videos.length - 1)"
            v-on:click="changeIndex(index + 1)"
          ><i class="fas fa-arrow-right"></i></a>
        </div>
      </div>
      <div class="col-md-2 creator">
        <span v-if="playlist.creator">
          <a :href="creatorProfileUrl"><i class="fas fa-user"></i> Created by {{ playlist.creator.name }}</a>
        </span>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data: function() {
    return {
      playlist: this.$parent.playlist,
      index: this.$parent.index,
      editUrl: this.$parent.editUrl,
      deleteUrl: this.$parent.deleteUrl,
      creatorProfileUrl: this.$parent.creatorProfileUrl,
      maxThumbs: 10
    };
  },
  methods: {
    init: function() {
      var videos = this.playlist.videos;
      var index = this.index;
      if (!this.pageVideos) this.pageVideos = videos.slice(0, this.maxThumbs);

      var current = videos[index];
      current.iframeClass =
        "embed__aspect-ratio embed__aspect-ratio--" +
        (current.widescreen ? "16by9" : "4by3");
      current.iframeBackgroundImg = current.thumbnailSrc;

      for (var i = 0; i < videos.length; i++) {
        var video = videos[i];
        video.linkClass = i == index ? "active" : "";
      }
      this.currentVideo = current;
    },
    changeIndex: function(i) {
      this.index = i;
      if (this.index >= this.maxThumbs) {
        this.pageVideos.shift();
        this.pageVideos.push(this.playlist.videos[i]);
      }
      this.init();
    },
    moveOn: function() {
    	if (this.index < this.playlist.videos.length) this.changeIndex(this.index + 1);
    },
    selectVideo: function(pageVideoIndex) {
      var i = this.playlist.videos.indexOf(this.pageVideos[pageVideoIndex]);
      this.changeIndex(i);
    },
    deletePlaylist: function(playlist) {
        console.log(playlist);
        axios
            .delete('/playlist/' + playlist.slug)
            .then(response => {
                window.location = '/'
            })
            .catch(error => {
                console.log(error)
            })
    }
  },
  created: function() {
    this.init();
  },
  updated: function() {
    document.dispatchEvent(new Event('mainviewerready'));
  }
};
</script>
