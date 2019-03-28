@extends('layouts.admin')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="row">
                    <div class="col-12">
                        @include('admin.partials.stats')
                    </div>
                    <div class="col-12 mt-3">
                        @include('admin.partials.video-form')
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 mt-3 mt-lg-0">
                <div class="row">
                    <div class="col-12">
                        @include('admin.partials.users')
                    </div>
                    <div class="col-12 mt-3">
                        @include('admin.partials.videos')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
