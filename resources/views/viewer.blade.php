@extends('layouts.app')

@section('content')
    <div class="container">
        Look at all these cute animals... You monster!
        @include("inc.embed", ['video' => $video ])
    </div>
@endsection
