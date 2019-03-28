@extends('layouts.admin')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-12 col-lg-6 offset-lg-3">
                @if (session('update_video_status'))
                    <div class="alert alert-success mb-2">
                        {{session('update_video_status')}}
                    </div>
                @endif

                @include('admin.partials.video-form')
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12 col-lg-6 offset-lg-3">
                <a href="/admin">Back to admin dashboard</a>
            </div>
        </div>
    </div>
@endsection

