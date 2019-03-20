<div class="card">
    <div class="card-header text-center">
        <a href="{{ route( 'playlist.show', $playlist ) }}">{{ $playlist->name }}</a>
    </div>
    <div class="card-body">
        <ul class="list-group">
        @foreach( $playlist->videos as $video )
          <li class="list-group-item">
              <a class="d-flex justify-content-between align-items-center" href="{{ route( 'playlist.video.show', [ $playlist, $video ] ) }}">
                  @include('inc.videothumb')
                  {{ $video->title }}
                  <small>{{ $video->getTime() }}</small>
              </a>
          </li>
        @endforeach
        </ul>
    </div>
    <div class="card-header text-center">
        @include('inc.listbuttons')
    </div>
</div>
