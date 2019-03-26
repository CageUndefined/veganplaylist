<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// See https://laravel.com/docs/5.8/eloquent-relationships
// for more information about defining and using model relationships

class Playlist extends Model {

	protected $visible = ['name', 'slug', 'creator', 'videos', 'views'];
	protected $fillable = ['views'];

	public function creator() {
		return $this->hasOne('App\User', 'id', 'creator_id');
	}

	public function videos() {
		return $this->belongsToMany('App\Video', 'playlist_video_map');
	}

	public function videoData() {
		$videoModels = $this->videos;
		$videoData = [];
		foreach ($videoModels as $vm) {
			array_push($videoData, $vm->viewerData());
		}
		return $videoData;
	}

	public static function boot() {
		parent::boot();

		static::saving(function ($model) {
			$model->slug = str_slug($model->name);
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

	public function incrementViews() {
		$this->views = $this->views + 1;
		$this->save();
	}
}
