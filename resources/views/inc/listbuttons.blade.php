<div class="container">
    <a href="{{ route( 'playlist.show', $playlist ) }}" class="btn btn-primary">View</a>
    <a href="#" class="btn btn-primary">Copy</a>
    <a data-network="sharethis" class="st-custom-button btn btn-primary" data-url="{{ $playlist->getShortUrl() }}" data-title="{{ $playlist->name }}"><span class="count"></span>Share</a>
</div>
