<div class="card playlist-card"
     style="box-shadow: -1px 1px 11px 0px rgba(0, 0, 0, 0.26);border-radius: 10px 10px 10px 10px;">

    <div class="card-header text-center d-flex align-items-center justify-content-center"
         style="background-size: cover; background-repeat: no-repeat;padding-top: 8px;border-radius: 10px 10px 0px 0px;padding-bottom: 5px;background-image: url(https://i.imgur.com/ESi8MTp.jpg);color: black; cursor: pointer;"
         onclick="window.location.href = '{{ route( 'playlist.show', $playlist ) }}'">
        <i class="fas fa-play-circle mr-2 text-white" style="font-size: 25px;"></i>
        <a style="font-weight: 600;letter-spacing: 2px;"
           href="{{ route( 'playlist.show', $playlist ) }}">{{ $playlist->name }}</a>
    </div>
    <ul class="list-group">
        <table>

            <tr>
                <td align="center" style="padding: 15px;"><i class="fas fa-share"></i> Share</td>
                <td><i class="fas fa-link"></i> Copy URL</td>
                <td align="right" style="padding-right: 18px;">Total: <b>1:23:33</b></td>
            </tr>

        </table>

        @foreach( $playlist->videos as $video )
            @if ($loop->iteration > 10)
                @if ($loop->last)
                    <li class="list-group-item text-center" style="padding-left: 20px; padding-right: 10px;">
                        <a href="{{ route( 'playlist.show', $playlist ) }}" class="text-muted">
                            And {{ $playlist->videos->count() - 10 }} more!
                        </a>
                    </li>
                @endif
            @else
                <li class="list-group-item" style="padding-left: 20px;padding-right: 10px;">
                    <a class="row" href="{{ route( 'playlist.video.show', [ $playlist, $video ] ) }}">
                        <div class="col-3">@include('inc.videothumb')</div>
                        <div class="col-7 text-truncate"
                             style="white-space: inherit !important;color: #000;text-decoration: none;font-weight: 600;margin: -10px 0px 0px 15px;">{{ $video->title }}</div>
                    <!--<small class="col-1 text-right" style="padding: 0px;">{{ $video->getTime() }}</small>-->
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</div>
