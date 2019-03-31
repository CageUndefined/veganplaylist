<li class="list-group-item" id="list_item_{{ $video->id }}">
    <div class="d-flex align-items-center flex-row">
        <div class="mr-2">@include('inc.videothumb')</div>
        <div class="font-weight-bold text-wrap">{{ $video->title }}</div>
        <button data-id="{{ $video->id }}" class="remove text-danger ml-2 border-0 bg-transparent">
            <i class="fas fa-trash-alt"></i>
        </button>
    </div>
</li>
