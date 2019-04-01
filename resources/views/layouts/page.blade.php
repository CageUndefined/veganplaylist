@extends('layouts.app')

@section('content')

    @include('inc.navbar')
    <main class="py-4">
        @yield('page_content')
    </main>
    @if (!isset($suppressFooter) || !$suppressFooter)
        @include('inc.footer')
    @endif
@endsection
