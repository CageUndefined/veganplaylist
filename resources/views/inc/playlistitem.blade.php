<?php
	$linkClass = 'playlist-scroller__item'.
		(($active ?? false) ? ' playlist-scroller__item--active' : '');
?>

<a href="{{ $video["path"] }}" class="{{ $linkClass }} ">
	<img src="{{ $video["thumbnailSrc"] }}" class="img-fluid img-thumbnail" alt="">
</a>