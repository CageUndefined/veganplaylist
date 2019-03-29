<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Video extends Model {

    protected $fillable = ['service', 'service_video_id', 'title', 'length', 'widescreen', 'graphic', 'mature'];
    protected $visible = ['src', 'thumbnailSrc', 'title', 'slug', 'length', 'widescreen', 'graphic', 'mature', 'tags', 'service'];

    public static function boot() {
        parent::boot();

        static::creating(function ($video) {
            $video->slug = str_slug($video->title);
        });

        static::deleting(function($video) {
            $video->tags()->detach();
        });

        static::retrieved(function ($video) {
            $video->src = $video->getEmbedSrcAttribute();
            $video->thumbnailSrc = $video->getThumbnailSrcAttribute();
        });
    }

    public function getRouteKeyName() {
        return 'slug';
    }

    public function getThumbnailSrcAttribute() {
        switch ($this['service']) {
        case 'y':
            return "https://img.youtube.com/vi/" . $this['service_video_id'] . "/hqdefault.jpg";
        case 'v':
            $url = 'https://vimeo.com/api/oembed.json?url=https://vimeo.com/';
            $json = json_decode(@file_get_contents($url . $this['service_video_id']));
            return isset($json->thumbnail_url) ? $json->thumbnail_url : '';
        default:
            throw new Exception("Service char out of range: '" . $this['service'] . "'..!", 1);
        }
    }

    public function getEmbedSrcAttribute() {
        switch ($this['service']) {
        case 'y':
            return "https://www.youtube-nocookie.com/embed/" . $this['service_video_id'] . "?autoplay=1&rel=0&enablejsapi=1";
        case 'v':
            return "https://player.vimeo.com/video/" . $this['service_video_id'] . "?autoplay=1";
        default:
            throw new Exception("Service char out of range: '" . $this['service'] . "'..!", 1);
        }
    }

    public function getAspectRatioAttribute() {
        return $this['widescreen'] ? '16by9' : '4by3';
    }

    public function getTime() {
        return sprintf("%d:%02d", $this->length / 60, $this->length % 60);
    }

    public function tags() {
        return $this->belongsToMany('App\Tag', 'video_tag_map');
    }

    public static function parseUrl(string $url) {
        if (substr($url, 0, 4) !== "http") {
            $url = 'https://' . $url;
        }

        $url_data = parse_url($url);
        $hostname = Arr::get($url_data, 'host', '');

        $is_youtube = preg_match('/(www\.)?youtube.com/', $hostname);
        $is_vimeo = preg_match('/(www\.)?vimeo.com/', $hostname);

        if ($is_youtube) {
            parse_str($url_data['query'], $parsed_query);

            return [
            'service' => 'y',
            'service_video_id' => $parsed_query['v'],
            ];
        } else if ($is_vimeo) {
            return [
            'service' => 'v',
            'service_video_id' => str_replace('/', '', $url_data['path']),
            ];
        } else {
            throw new \InvalidArgumentException('Must be a valid YouTube or Vimeo URL');
        }
    }
}
