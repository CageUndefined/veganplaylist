@extends('layouts.admin')

@if (session('error'))
    <div class="alert">
        {{ session('error') }}
    </div>
@endif

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3">
            <form method="POST" action="/admin/login">
                @csrf

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control" />
                </div>


                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" />
                </div>

                <button type="submit" class="btn btn-primary">Log in</button>
            </form>
        </div>
    </div>
</div>
@endsection
