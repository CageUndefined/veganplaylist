<div class="border border-info">
    <div class="bg-info text-white p-3">
        <span class="h2 m-0">Users</span>
    </div>

    <ul class="list-unstyled m-0">
        @if (session('delete_user_status'))
            <div class="alert alert-info">
                {{session('delete_user_status')}}
            </div>
        @endif
        @foreach ($users as $user)
            <li class="@if (!$loop->last) border-bottom border-info @endif px-3 py-1 d-flex align-items-center justify-content-between">
                {{$user->email}}

                <button class="btn btn-danger btn-sm ml-2 delete-user" data-id="{{$user->id}}" data-email="{{$user->email}}">
                    Delete
                </button>
            </li>
        @endforeach
    </ul>
</div>
