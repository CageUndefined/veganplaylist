@extends('layouts.app')

@section('content')
    @include('inc.navbar')
    <main class="py-4">
        @yield('content')
    </main>
@endsection
