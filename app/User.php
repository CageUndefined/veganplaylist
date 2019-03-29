<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $visible = [ 'id', 'name' ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot() {
        parent::boot();

        static::saving(function ($user) {
            $user->slug = str_slug($user->name);
        });

        static::deleting(function($user) {
            $user->playlists()->each(function($p) { $p->delete(); });
        });
    }

    
    public function getRouteKeyName() {
        return 'slug';
    }
    

    public function playlists()
    {
        return $this->hasMany('App\Playlist', 'creator_id');
    }
}
