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
                    <a href="{{ url('/viewer') }}">Also, click here!</a>
                </div>
            </div>
            <br><br>
            <div class="card-columns">
                @include('playlistcard', [ 'item_count' => 4 ])
                @include('playlistcard', [ 'item_count' => 7 ])
                @include('playlistcard', [ 'item_count' => 3 ])
                @include('playlistcard', [ 'item_count' => 4 ])
                @include('playlistcard', [ 'item_count' => 5 ])
        </div>
    </div>
@endsection
