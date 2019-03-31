
@foreach ( $videos as $video )
    <div class="card video-card" id="card_{{ $video->id }}">
        <a href="{{$video->getEmbedSrcAttribute()}}}" class="playlist-editor-thumbnail" data-title="{{$video->title}}">
            <img class="card-img-top" src="{{ $video->getThumbnailSrcAttribute() }}" />
        </a>
        <div class="card-body text-center">
            <p class="card-text">{{ $video->title }} - <span class="text-secondary">{{ $video->getTime() }}</span></p>
            <button class="btn btn-primary btn-add" data-id="{{ $video->id }}">Add to playlist</button>
        </div>
    </div>
@endforeach
