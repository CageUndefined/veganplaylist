<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// See https://laravel.com/docs/5.8/eloquent-relationships
// for more information about defining and using model relationships

class Playlist extends Model {

    protected $visible = ['id', 'name', 'slug', 'creator', 'videos', 'views', 'display_length'];
    protected $fillable = ['views', 'name'];

    public function creator() {
        return $this->hasOne('App\User', 'id', 'creator_id');
    }

    public function videos() {
        return $this->belongsToMany('App\Video', 'playlist_video_map');
    }

    public static function boot() {
        parent::boot();

        static::creating(function ($playlist) {
            $playlist->slug = str_slug($playlist->name);
        });

        static::deleting(function($playlist) {
            $playlist->videos()->detach();
        });

        static::retrieved(function ($playlist) {
            $playlist->display_length = $playlist->getDisplayLengthAttribute();
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

    public function getDisplayLengthAttribute() {
        $secondLength = 0;
        $videoModels = $this->videos;
        foreach ($videoModels as $vm) {
            $secondLength += $vm->length;
        }
        return gmdate("H:i:s", $secondLength);
    }
}
