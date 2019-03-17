@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <div class="card">
            <div class="card-header">
                Filter Videos
            </div>
            <div class="card-body">
                <form id='filter-form'>
                    <div class="row">
                        <div class="col">
                        <input type="text" class="form-control" id="name_input" name="name" placeholder="Search by name" value="{{ $name }}">
                        </div>
                        <div class="col">
                            <div id="lables-active" class="" style="display:none"></div>
                            <div id="lables-inactive" class="justify-content-end">
                                <span class="text-secondary mr-2">Tags: </span>
                                <span class="badge badge-pill badge-primary">Ethics</span>
                                <span class="badge badge-pill badge-secondary">Humor</span>
                                <span class="badge badge-pill badge-success">Environment</span>
                                <span class="badge badge-pill badge-danger">Health</span>
                                <span class="badge badge-pill badge-primary">Inspiring</span>
                                <span class="badge badge-pill badge-warning">Documentary</span>
                                <span class="badge badge-pill badge-success">Fitness</span>
                                <span class="badge badge-pill badge-info">Information</span>
                                <span class="badge badge-pill badge-dark">Activism</span>
                                <span class="badge badge-pill badge-light">Speech</span>
                                <span class="badge badge-pill badge-warning">Music</span>
                                <span class="badge badge-pill badge-danger">Recipes</span>
                                <span class="badge badge-pill badge-secondary">Science</span>
                            </div>
                        </div>

                     </div>
                </form>
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
    </div>
    <example-component></example-component>
@endsection
