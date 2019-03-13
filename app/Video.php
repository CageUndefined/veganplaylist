<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function getThumbnailSrcAttribute() {
    	return "https://img.youtube.com/vi/".$this['service_video_id']."/hqdefault.jpg";
    }

    public function getEmbedSrcAttribute() {
    	return "https://invidio.us/embed/".$this['service_video_id'];
    }

    public function getAspectRatioAttribute() {
    	return $this['widescreen'] ? '16by9' : '4by3';
    }

    public function getPathAttribute() {
    	return "/viewer/".($this['id'] - 1);
    }
}
