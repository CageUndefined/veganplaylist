<li class="list-group-item" id="list_item_{{ $video->id }}">
    <div class="row">
        <div class="col-3">
            <img style="max-width: 80px; max-height: 45px;" src="{{ $video->getThumbnailSrcAttribute() }}"/>
        </div>
        <div class="col-7 align-middle text-truncate">
            {{ $video->title }}
        </div>
        <div class="col-1 align-middle">
            <a href="#" data-id="{{ $video->id }}" class="remove text-danger ml-2">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>
    </div>
</li>
