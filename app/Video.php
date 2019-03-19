<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model {
	public function getThumbnailSrcAttribute() {

		switch ($this['service']) {
		case 'y':
			return "https://img.youtube.com/vi/" . $this['service_video_id'] . "/hqdefault.jpg";
		case 'v':
			$url = 'https://vimeo.com/api/oembed.json?url=https://vimeo.com/';
			$json = json_decode(file_get_contents($url . $this['service_video_id']));
			return $json->thumbnail_url;
		default:
			throw new Exception("Service char out of range: '" . $this['service'] . "'..!", 1);
		}
	}

	public function getEmbedSrcAttribute() {

		switch ($this['service']) {
		case 'y':
			return "https://invidio.us/embed/" . $this['service_video_id'];
		case 'v':
			return "https://player.vimeo.com/video/" . $this['service_video_id'];
		default:
			throw new Exception("Service char out of range: '" . $this['service'] . "'..!", 1);
		}
	}

	public function getAspectRatioAttribute() {
		return $this['widescreen'] ? '16by9' : '4by3';
	}

    public function getTime()
    {
        return sprintf( "%d:%02d", $this->length / 60, $this->length % 60 );
    }
}
