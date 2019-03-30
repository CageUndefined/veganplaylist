<div class="border border-primary">
    <div class="bg-primary text-white p-3">
        <span class="h2 m-0">Stats</span>
    </div>

    <div class="h3 m-0 p-3 border-bottom border-primary d-flex justify-content-between">
        Users

        <div class="text-truncate" title="{{$numUsers}}">
            <span class="badge badge-primary">
                {{$numUsers}}
            </span>
        </div>
    </div>
    <div class="h3 m-0 p-3 border-bottom border-primary d-flex justify-content-between">
        Videos

        <div class="text-truncate" title="{{$numVideos}}">
            <span class="badge badge-primary">
                {{$numVideos}}
            </span>
        </div>
    </div>
    <div class="h3 m-0 p-3 border-bottom border-primary d-flex justify-content-between">
        Playlists

        <div class="text-truncate" title="{{$numPlaylists}}">
            <span class="badge badge-primary">
                {{$numPlaylists}}
            </span>
        </div>
    </div>
    <div class="h3 m-0 p-3 d-flex justify-content-between">
        Playlist views

        <div class="text-truncate" title="{{$numPlaylistViews}}">
            <span class="badge badge-primary">
                {{$numPlaylistViews}}
            </span>
        </div>
    </div>
</div>
