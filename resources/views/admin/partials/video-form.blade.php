@php
    $tagWhitelist = $allTags->implode('name', ',');
    $isNewVideo = !isset($video);

    $url = '';

    if (!$isNewVideo) {
        $url = $video->service === 'y'
         ? "https://youtube.com/watch?v={$video->service_video_id}"
         : "https://vimeo.com/{$video->service_video_id}";
    }

    $url = old('url', $url);

    $title = old('title', !$isNewVideo ? $video->title : '');
    $duration = old('duration', !$isNewVideo ? $video->length : '');
    $widescreen = old('widescreen', !$isNewVideo ? $video->widescreen : '');
    $graphic = old('graphic', !$isNewVideo ? $video->graphic : '');
    $mature = old('mature', !$isNewVideo ? $video->mature : '');

    $taglist = old('taglist', !$isNewVideo ? implode(',', $video->tags()->pluck('name')->toArray()) : '');
    $tags = old('tags', !$isNewVideo ? implode(',', $video->tags()->pluck('name')->toArray()) : '');

    $action = $isNewVideo ? '/videos' : "/videos/{$video->id}";
@endphp

<script>
    window.MIX_YOUTUBE_API_KEY = "{{env('MIX_YOUTUBE_API_KEY')}}"
</script>

<div class="border border-success">
    <div class="bg-success text-white p-3">
        <span class="h2 m-0">@if ($isNewVideo) Add @else Edit @endif video</span>
    </div>

    <form class="p-3" method="POST" action="{{$action}}">
        @csrf
        @if (!$isNewVideo)
            <input type="hidden" name="_method" value="PUT" />
        @endif

        <div class="form-group">
            <label for="url">URL (https://youtube.com/watch?v=... or https://vimeo.com/...)</label>
            <input type="text" id="url" name="url" class="form-control" value="{{$url}}" required />
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="form-control" value="{{$title}}" required @if ($isNewVideo) disabled @endif />
        </div>
        <div class="form-group">
            <label for="duration">Duration</label>
            <input type="text" id="duration" name="duration" class="form-control" value="{{$duration}}" required readonly />
        </div>
        <div class="form-group">
            <label for="tags">Tags</label>
            <input name="taglist" id="tags" data-whitelist="{{$tagWhitelist}}" value="{{$taglist}}"" />
            <input type="hidden" name="tags" value="{{$tags}}" />
        </div>
        <div class="form-group form-check">
            <input type="checkbox" id="widescreen" name="widescreen" class="form-check-input" @if($widescreen) checked @endisset />
            <label for="widescreen" class="form-check-label">Widescreen</label>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" id="graphic" name="graphic" class="form-check-input" @if($graphic) checked @endisset />
            <label for="graphic" class="form-check-label">Graphic</label>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" id="mature" name="mature" class="form-check-input" @if($mature) checked @endisset />
            <label for="mature" class="form-check-label">Mature</label>
        </div>
        <button type="submit" class="btn btn-success">@if ($isNewVideo) Add @else Edit @endif video</button>

        @if ($errors->any())
            <div class="alert alert-danger m-0 mt-3">
                <ul class="m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('add_video_status'))
            <div class="alert alert-success m-0 mt-3">
                {{session('add_video_status')}}
            </div>
        @endif
    </form>
</div>
