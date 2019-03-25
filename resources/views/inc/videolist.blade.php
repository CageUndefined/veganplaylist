
@foreach ( $videos as $video )
    <div class="card video-card" id="card_{{ $video->id }}">
        <img class="card-img-top" src="{{ $video->getThumbnailSrcAttribute() }}" />
        <div class="card-body text-center">
            <p class="card-text">{{ $video->title }} - <span class="text-secondary">{{ $video->getTime() }}</span></p>
            <button class="btn btn-primary btn-add" data-id="{{ $video->id }}">Add</button>
            {{-- <a class="btn btn-secondary" href="{{ route( 'playlist.video.show', [ $playlist, $video ] ) }}">View</a> --}}
        </div>
    </div>
@endforeach