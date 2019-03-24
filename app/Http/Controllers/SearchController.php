<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;

class SearchController extends Controller
{

    public function search( $title, $tags = '' ) {
        
        if( empty( $tags ) || preg_match('/^all$/', $tags ) ) {
            $tags = [];
        } else {
            $tags = explode( ',', $tags );
        }

        $query = Video::where( 'title', 'LIKE', "%$title%" );
        
        foreach( $tags as $tag )
            $query->whereHas( 'tags', function( $query ) use ( $tag ) {
                return $query->where( 'id', $tag );
        } );

        $videos = $query->get();
        return response()->json( $videos, 200 );

    }

    public function search_tag( $tags, $title = '' ) {
        
        return $this::search( $title, $tags );

    }

}
