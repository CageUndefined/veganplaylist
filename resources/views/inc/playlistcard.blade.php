<div class="card playlist-card">
    <div class="card-header text-center">
        <a href="{{ route( 'playlist.show', $playlist ) }}">{{ $playlist->name }}</a>
    </div>
    <ul class="list-group">
    @foreach( $playlist->videos as $video )
      <li class="list-group-item" style="padding-left: 0px; padding-right: 0px;">
          <a class="row" href="{{ route( 'playlist.video.show', [ $playlist, $video ] ) }}">
              <div class="col-3">@include('inc.videothumb')</div>
              <div class="col-7 text-truncate">{{ $video->title }}</div>
              <small class="col-1 text-right" style="padding: 0px;">{{ $video->getTime() }}</small>
          </a>
      </li>
    @endforeach
    </ul>
    <div class="card-body text-center">
        @include('inc.listbuttons')
    </div>
</div>
