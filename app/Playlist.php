<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// See https://laravel.com/docs/5.8/eloquent-relationships
// for more information about defining and using model relationships

class Playlist extends Model {

    protected $visible = ['id', 'name', 'slug', 'creator', 'videos', 'views', 'display_length'];

    protected $fillable = ['views', 'name', 'creator_id'];

    public function creator() {
        return $this->hasOne('App\User', 'id', 'creator_id');
    }

    public function videos() {
        return $this->belongsToMany('App\Video', 'playlist_video_map')->withPivot('order')->orderBy('playlist_video_map.order');
    }

    public static function boot() {
        parent::boot();

        static::creating(function ($playlist) {
            $playlist->slug = str_slug($playlist->name);
        });

        static::deleting(function($playlist) {
            $playlist->videos()->detach();
        });
    }

    public function getRouteKeyName() {
        return 'slug';
    }

    public function getHash() {
        return PseudoCrypt::hash($this->id, 3);
    }

    public function getShortURL() {
        $hash = $this->getHash();
        return "https://vgn.soy/$hash";
    }

    public function getDisplayDurationAttribute() {
        $secondLength = 0;
        $videoModels = $this->videos;
        foreach ($videoModels as $vm) {
            $secondLength += $vm->length;
        }
        return $secondLength;
    }

    public function getDisplayLengthAttribute() {
        if( $this->display_duration < 3600 )
            return ltrim( gmdate("i:s", $this->display_duration), '0' );
            // LOLOL PHP DATE FORMAT STILL HAS NO MINUTES WITHOUT LEADING ZEROS
        else
            return gmdate("G:i:s", $this->display_duration);
    }
}
