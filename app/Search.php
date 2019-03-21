<?php

namespace App;

use App\Video;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Search extends Model {

    public static function searchByTags( $tags = [] ) {

        $query = DB::table( 'videos' );

        foreach( $tags as $tag )
            $query->{ $tag == '4' ? 'whereNotExists' : 'whereExists' }( function( $subQuery ) use( $tag ) {
                $subQuery->select( DB::raw(1) )->from( 'video_tag_map' )->whereRaw( '`videos`.`id` = `video_tag_map`.`video_id`' )->where( 'video_tag_map.tag_id', '=', $tag );
            } );

        return $query->get();
	}

    public static function searchByTitle( $title = '' ) {

        return Video::where('title', 'like', '%' . $title . '%')->get();
	}
}
