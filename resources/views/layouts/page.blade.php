@extends('layouts.app')

@section('content')

    @include('inc.navbar')
    <main class="py-4">
        @yield('page_content')
    </main>
    @include('inc.footer')
@endsection
