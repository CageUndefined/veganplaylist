@php    
    $videos = App\Video::all();
@endphp

@extends('layouts.page')

@section('content')
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
                                    <label for="graphic-input">Graphic:</label>
                                </div>
                                <div class="col-sm-1">
                                    <input type="checkbox" id="graphic-input" checked />
                                </div>
                                <div class="col-sm-2" title="Content with language/nudity/violence">
                                    <label for="nsfw-input">NSFW:</label>
                                </div>
                                <div class="col-sm-1">
                                    <input type="checkbox" id="nsfw-input" checked />
                                </div>
                            </div>
                        </div>
                        <div id="tags" class="col mr-2">
                            <div class="row mb-3 mt-2 justify-content-end">
                                <div id="labels-inactive" class="">
                                    <span class="text-secondary mr-2">Tags: </span>
                                    <!-- v-if="tags.length" -->
    
                                    <!-- <TagItem
            				            v-for="tag in tags"
            				            v-bind:key="tag.id"
            				            v-bind:tag="tag"
            				            @remove="removeTag"
            			            />
            
            		                <p v-else>
            			                No tags available.
            		                </p> -->
    
                                    <a href="#" class="badge badge-pill badge-primary">Ethics</a>
                                    <a href="#" class="badge badge-pill badge-secondary">Humor</a>
                                    <a href="#" class="badge badge-pill badge-success">Environment</a>
                                    <a href="#" class="badge badge-pill badge-danger">Health</a>
                                    <a href="#" class="badge badge-pill badge-primary">Inspiring</a>
                                    <a href="#" class="badge badge-pill badge-warning">Documentary</a>
                                    <a href="#" class="badge badge-pill badge-info">Information</a>
                                    <!-- <a href="#" class="badge badge-pill badge-success">Fitness</a> -->
                                    <a href="#" class="badge badge-pill badge-dark">Activism</a>
                                    <a href="#" class="badge badge-pill badge-light">Speech</a>
                                    <a href="#" class="badge badge-pill badge-warning">Music</a>
                                    <a href="#" class="badge badge-pill badge-danger">Recipes</a>
                                    <!-- <a href="#" class="badge badge-pill badge-secondary">Science</a> -->
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div id="labels-active">
                                    <a href="#" class="badge badge-secondary">Science | x</a>
                                    <a href="#" class="badge badge-success">Fitness | x</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-8">
                <div class="card-columns">
                    @include('inc.videolist')
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div id="new_playlist">
                        <div class="card-header text-center" id="playlist_name">Your Playlist</div>
                        <div class="card-body text-center">
                            <p><em>Search for videos using the filter above</em></p>
                            <ol class="list-group text-left"></ol>
                        </div>
                        <div class="card-footer text-center">
                            <a href="#" class="btn btn-primary playlist-save disabled">Create Playlist</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
