@extends('layouts.main')

@section('content')
    @include('inc.searchbar')
    <div class="container">
        Welcome! Please convert to veganism.<br/>
        <a href="{{ url('/viewer') }}">Also, click here!</a>
        <br><br>
        <div class="container">
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
        </div>
    </div>
@endsection
