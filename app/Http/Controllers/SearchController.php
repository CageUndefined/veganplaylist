<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Search;

class SearchController extends Controller
{

    public function search( $tags = '' ) {
        
        if( empty( $tags ) )
            $tags = [];
        else
            $tags = explode( ',', $tags );

        $videos = Search::searchByTags( $tags );
        return response()->json( $videos, 200 );

    }

}
