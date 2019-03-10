@extends('layouts.app')

@section('content')
    @include('inc.searchbar')
    <div class="container">
        <div class="container">
            <div class="card">
                <div class="card-header">Dashboard</div>
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
            <div class="row">
                <div class="col-sm">
                    @include('playlist')
                </div>
                <div class="col-sm">
                    @include('playlist')
                </div>
                <div class="col-sm">
                    @include('playlist')
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm">

                </div>
                <div class="col-sm">

                </div>
                <div class="col-sm">
                    @include('playlist')
                </div>
            </div>
        </div>
    </div>
@endsection
