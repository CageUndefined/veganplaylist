<div class="border border-secondary">
    <div class="bg-secondary text-white p-3">
        <span class="h2 m-0">Videos</span>
    </div>

    <ul class="list-unstyled m-0 videos">
        @if (session('delete_video_status'))
            <div class="alert alert-secondary">
                {{session('delete_video_status')}}
            </div>
        @endif
        @foreach ($videos as $video)
            <li class="@if (!$loop->last) border-bottom border-secondary @endif px-3 py-1 d-flex align-items-center justify-content-between">
                {{$video->title}}

                <div class="ml-2 d-flex">
                    <a href="/videos/{{$video->id}}/edit" class="btn btn-secondary btn-sm delete-video">
                        Edit
                    </a>

                    <button class="btn btn-danger btn-sm ml-1 delete-video" data-id="{{$video->id}}" data-title="{{$video->title}}">
                        Delete
                    </button>
                </div>
            </li>
        @endforeach
    </ul>
</div>
