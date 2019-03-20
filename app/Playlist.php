<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// See https://laravel.com/docs/5.8/eloquent-relationships
// for more information about defining and using model relationships

class Playlist extends Model
{
    public function creator()
    {
        return $this->hasOne('App\User', 'id', 'creator_id');
    }

    public function videos()
    {
        return $this->belongsToMany('App\Video', 'playlist_video_map');
    }

    public static function boot()
    {
        parent::boot();

        static::saving( function( $model ) {
            $model->slug = str_slug( $model->name );
        } );
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
