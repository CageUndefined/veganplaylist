<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Search;

class SearchController extends Controller
{

    public function search_tags( $tags = '' ) {

        if( empty( $tags ) )
            $tags = [];
        else
            $tags = explode( ',', $tags );

        $videos = Search::searchByTags( $tags );
        return response()->json( $videos, 200 );

    }

    public function search_title( $title = '' ) {

        $sanitized = preg_replace('/[^\w\s,:!.-]*/', '', $title);

        $videos = Search::searchByTitle( $sanitized );

        return response()->json( $videos, 200 );
    }
}
