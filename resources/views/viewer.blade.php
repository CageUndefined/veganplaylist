@extends('layouts.page')

@section('title', 'View Playlist')

@section('page_content')
    <div id="viewer_app">
        <main-viewer></main-viewer>
    </div>
    <script>
        const viewer = new Vue({
            el: '#viewer_app',
            data: {
                playlist: @json( $playlist ),
                index: @json( $index ),
                editUrl: @json($editUrl),
                creatorProfileUrl: @json($creatorProfileUrl)
            },
            computed: {
                nonNullItems: function() {
                    return this.items.filter(function(item) {
                        return item !== null;
                    });
                }
            }
         });

    </script>
@endsection
