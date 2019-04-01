<div class="card playlist-card shadow-sm">
    <div class="card-header text-center d-flex align-items-center justify-content-center"
         style="background-size: cover; background-position-y: 50%; background-repeat: no-repeat;padding-top: 8px;border-radius: 10px 10px 0px 0px;padding-bottom: 5px;background-image:linear-gradient(to bottom, rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)),  url({{ $playlist->videos[0]->getThumbnailSrcAttribute() }});color: black; cursor: pointer;"
         onclick="window.location.href = '{{ route( 'playlist.show', $playlist ) }}'">
        <i class="fas fa-play-circle mr-2 text-white" style="font-size: 25px;"></i>
        <a style="font-weight: 600;letter-spacing: 2px;text-decoration:none;"
           href="{{ route( 'playlist.show', $playlist ) }}">{{ $playlist->name }}</a>
    </div>
    <div class="d-flex flex-row flex-sm-column flex-md-row text-center py-3 py-sm-0 py-md-3">
        <button
            class="flex-fill py-0 py-sm-2 py-md-0 bg-transparent border-0 st-custom-button"
            data-network="sharethis"
            data-url="{{ route( 'playlist.show', $playlist ) }}"
            data-short-url="{{ $playlist->getShortUrl() }}"
            data-title="{{ $playlist->name }}"
            data-image="{{ $playlist->videos[0]->getThumbnailSrcAttribute() }}"
            data-description="Watch {{ $playlist->name }} and many other playlists of vegan videos on VeganPlaylist.org!"
        >
            <span class="count"></span>
            <i class="fas fa-share"></i> Share
        </button>
        <button
            class="flex-fill py-0 py-sm-2 py-md-0 bg-transparent border-0 copy-playlist-url-btn"
            data-clipboard-text="{{$playlist->getShortUrl()}}"
        >
            <i class="fas fa-user-edit"></i> Copy URL
        </button>
        @if( $playlist->creator && $playlist->creator->is( Auth::user() ) )
            <button
                class="flex-fill py-0 py-sm-2 py-md-0 bg-transparent border-0"
                onclick="document.location = '{{ route( 'playlist.edit', $playlist ) }}'"
            >
                <i class="fas fa-link"></i> Edit
            </button>
        @endif
        <div class="flex-fill py-0 py-sm-2 py-md-0">
            Total: <b>{{$playlist->display_length}}</b>
        </div>
    </div>
    <ul class="list-group">
        @foreach( $playlist->videos as $video )
            @if ($loop->iteration > 10)
                @if ($loop->last)
                    <li class="list-group-item text-center">
                        <a href="{{ route( 'playlist.show', $playlist ) }}" class="text-muted">
                            And {{ $playlist->videos->count() - 10 }} more!
                        </a>
                    </li>
                @endif
            @else
                <li class="list-group-item">
                    <a
                        class="d-flex align-items-center align-items-sm-start align-items-lg-center flex-row flex-sm-column flex-lg-row text-truncate text-wrap font-weight-bold text-dark text-decoration-none"
                        href="{{ route( 'playlist.video.show', [ $playlist, $video ] ) }}"
                    >
                        <div class="mr-2 mb-0 mb-sm-2 mb-lg-0">@include('inc.videothumb')</div>
                        {{ $video->title }}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</div>
