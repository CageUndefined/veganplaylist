@php    
    $playlists = App\Playlist::where( 'featured', true )->get();
@endphp

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <div class="card">
                <div class="card-body">
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
                 @include('playlistcard')
               @endforeach
        </div>
    </div>
@endsection
