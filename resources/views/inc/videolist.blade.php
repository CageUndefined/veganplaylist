
@foreach ( $videos as $video )

@php
    $to_display = '';

    if ($isEdit and $playlist_items->contains($video)) {
        $to_display = 'display: none;';
    }
@endphp

    <div class="card video-card" id="card_{{ $video->id }}"
        style="{{ $to_display }}">
        <a href="{{$video->getEmbedSrcAttribute()}}" class="playlist-editor-thumbnail" data-title="{{$video->title}}">
            <img class="card-img-top" src="{{ $video->getThumbnailSrcAttribute() }}" />
            <div class="play-button"></div>
        </a>
        <div class="card-body text-center">
            <p class="card-text">{{ $video->title }} - <span class="text-secondary">{{ $video->getTime() }}</span></p>
            <button class="btn btn-primary btn-add" data-id="{{ $video->id }}">Add to playlist</button>
        </div>
    </div>
@endforeach
