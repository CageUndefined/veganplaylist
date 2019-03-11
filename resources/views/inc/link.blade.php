
@if ($video)
	<a href="{{ $video["path"] }}">
		<img src="{{ $video["thumbnailSrc"] }}" class="img-fluid img-thumbnail" alt="">
	</a>
@endif