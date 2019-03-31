@php
    $videos = App\Video::all();
    $tags   = App\Tag::all();
@endphp

@section('title', 'Create Playlist')

@extends('layouts.page')

@section('page_content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Filter Videos
            </div>
            <div class="card-body">
                <form id='filter_form'>
                    {{ csrf_field() }}
                    <div class="row ml-2">
                        <div class="col-sm-4">
                            <div class="row">
                                <input type="text" class="form-control" id="name_input" placeholder="Search by name" />
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-2" title="Content that is stomach-turning">
                                    <label for="graphic_input">Graphic:</label>
                                </div>
                                <div class="col-sm-1">
                                    <input type="checkbox" id="graphic_input" value="1" checked />
                                </div>
                                <div class="col-sm-2" title="Content with language/nudity/violence">
                                    <label for="mature_input">Mature:</label>
                                </div>
                                <div class="col-sm-1">
                                    <input type="checkbox" id="mature_input" value="1" checked />
                                </div>
                            </div>
                            <div class="row">
                                <div id="labels_active"></div>
                            </div>
                        </div>
                        <div id="tags" class="col mr-2 ml-2">
                            <div class="row mb-3 mt-2 justify-content-end">
                                <div id="labels_inactive" class="">
                                    <span class="text-secondary mr-2">Tags: </span>
                                    @foreach ($tags as $t)
                                        <button class="border-0 badge badge-pill badge-{{ $t->{'color'} }}" data-id="{{ $t->{'id'} }}">{{ $t->{'name'} }}</button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-lg-8 order-last order-lg-first">
                <img src="{{ asset('img/loading.svg') }}" alt="Loading" class="loading-indicator d-none" />

                <div class="no-results d-none">No videos found</div>

                <div class="search-results">
                    @include('inc.videolist')
                </div>
            </div>
            <div class="col-12 col-lg-4 order-first order-lg-last mb-3">
                <div class="card">
                    <div id="new_playlist">
                        <div class="card-header text-center">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-signature"></i>
                                    </span>
                                </div>
                                <input type="text"
                                       class="form-control"
                                       placeholder="Playlist Name"
                                       id="playlist_name">
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <p><em>Search for videos using the filter above</em></p>
                            <ul class="list-group text-left"></ul>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn btn-primary playlist-save disabled">Create Playlist</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
