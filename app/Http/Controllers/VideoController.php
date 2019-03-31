<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function list(Request $request){
        $title = $request['title'];
        $tags  = $request['tags'];

        $where = array( array('title', 'LIKE', "%$title%") );
        if ($request['hide_graphic']) $where[] = array('graphic', '!=', '1');
        if ($request['hide_mature'])  $where[] = array('mature', '!=', '1');

        $query = Video::where( $where );

        foreach( $tags as $tag ) {
            $query->whereHas( 'tags', function( $query ) use ( $tag ) {
                return $query->where( 'id', $tag );
            });
        }

        $videos = $query->get();

        return view('inc.videolist', [
            'videos' => $videos
        ]);
    }
}
