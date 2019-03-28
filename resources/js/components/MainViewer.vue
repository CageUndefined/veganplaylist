<template>
  <div class="viewer">
    <div class="heading">
      <div class="container">
        <div class="row">
          <div class="title col-md-9">
            <h4>{{ playlist.name }}</h4>
          </div>
          <div class="stats col-md-3 row">
            <div class="col-md-4">
              views
              <br>
              {{ playlist.views }}
            </div>
            <div class="col-md-4">
              videos
              <br>
              {{ playlist.videos.length }}
            </div>
            <div class="col-md-4">
              run time
              <br>
              {{ playlist.display_length }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="subheading">
      <div class="container">
        <h5>
          {{ currentVideo.title }}
          <small>({{ (index + 1) }} / {{ playlist.videos.length }})</small>
        </h5>
      </div>
    </div>
    <div class="embed">
      <iframe class="embed__iframe" :src="currentVideo.src"></iframe>
    </div>
    <div class="navigation row">
      <div class="col-md-2">
        <a href>Edit</a>
      </div>
      <div class="container col-md-8 row">
        <div class="col-md-1">
          <a class="arrow" href="#" v-show="index > 0" v-on:click="changeIndex(index - 1)">&larr;</a>
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
          >&rarr;</a>
        </div>
      </div>
      <div class="col-md-2 creator">
        <span v-if="playlist.creator">
          Created by
          <a href>{{ playlist.creator.name }}</a>
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
    selectVideo: function(pageVideoIndex) {
      var i = this.playlist.videos.indexOf(this.pageVideos[pageVideoIndex]);
      this.changeIndex(i);
    }
  },
  created: function() {
    this.init();
  },
  updated: function() {
    this.init();
  }
};
</script>
