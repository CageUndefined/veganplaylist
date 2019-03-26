@extends('layouts.page')

@section('page_content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="I-dont-know-what-im-doing-frontend-is-scary" style="float: right;">
                    <form action="{{ route( 'playlist.create' ) }}" method="get">
                        <input name="name" placeholder="Playlist name (optional)" />
                        <button class="btn btn-primary">Create Playlist</button>
                    </form>
                </div>
                @guest
                    Welcome, Guest! Please convert to veganism.<br/>
                @else
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Welcome! You are logged in!<br/>
                @endguest
            </div>
        </div>
        <br><br>
        <div class="card-columns">
           @foreach( $playlists as $playlist )
             @include('inc.playlistcard')
           @endforeach
        </div>
    </div>
@endsection
