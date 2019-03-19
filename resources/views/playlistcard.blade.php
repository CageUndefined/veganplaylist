@php

    $playlist_id = 1;
    $playlist = App\Playlist::find( $playlist_id );
    
@endphp
<div class="card">
    <div class="card-header text-center">
              @include('inc.listbuttons')
    </div>
    <div class="card-body">
        <ul class="list-group">
        @foreach( $playlist->videos as $video )
          <li class="list-group-item d-flex justify-content-between align-items-center">
              <a href="{{ route( 'playlist.video.show', [ $playlist, $video ] ) }}">
                  {{ $video->title }}
                  <small>{{ $video->getTime() }}</small>
              </a>
          </li>
        @endforeach
        </ul>
        <br>
    </div>
</div>
