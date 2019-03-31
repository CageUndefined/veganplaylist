<li class="list-group-item">
    <div class="d-flex align-items-center flex-row">
        <div class="mr-2">@include('inc.videothumb')</div>
        <div class="font-weight-bold text-wrap">{{ $video->title }}</div>
        <a href="#" data-id="{{ $video->id }}" class="remove text-danger ml-2">
            <i class="fas fa-trash-alt"></i>
        </a>
    </div>
</li>
