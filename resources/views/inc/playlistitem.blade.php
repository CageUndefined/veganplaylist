<?php
	$linkClass = 'playlist-scroller__item'.
		(($active ?? false) ? ' playlist-scroller__item--active' : '');
?>

<a href="{{ route( 'playlist.video.show', [ $playlist, $video ] ) }}" class="{{ $linkClass }} ">
	<img src="{{ $video["thumbnailSrc"] }}" class="img-fluid img-thumbnail" alt="">
</a>
