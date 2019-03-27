
@if ($video)
	<a href="{{ route( 'playlist.video.show', [ $playlist, $video ] ) }}">
		<img src="{{ $video["thumbnailSrc"] }}" class="img-fluid img-thumbnail" alt="">
	</a>
@endif
