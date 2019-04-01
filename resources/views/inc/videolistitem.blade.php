<li class="playlist-list-group-item list-group-item" id="list_item_{{ $video->id }}" data-id="{{ $video->id }}">
    <div class="d-flex align-items-center flex-row">
        <div class="mr-3">
            <i class="fas fa-bars"></i>
        </div>
        <div class="mr-2">@include('inc.videothumb')</div>
        <div class="font-weight-bold text-wrap title">{{ $video->title }}</div>
        <button data-id="{{ $video->id }}" class="remove text-danger ml-2 border-0 bg-transparent flex-fill text-right">
            <i class="fas fa-trash-alt"></i>
        </button>
    </div>
</li>
