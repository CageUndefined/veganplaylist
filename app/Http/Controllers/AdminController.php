<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Playlist;
use App\Tag;
use App\User;
use App\Video;

class AdminController extends Controller
{
    private static $ADMIN_SESSION_KEY = 'IS_ADMIN';

    public function __construct() {
        $this->middleware(function (Request $request, $next) {
            if (!$this->isLoggedIn($request)) return redirect('/admin/login');

            return $next($request);
        })->except('login');
    }

    public function dashboard(Request $request)
    {
        $numPlaylistViews = Playlist::sum('views');
        $numUsers = User::count();
        $numVideos = Video::count();
        $tags = Tag::all();
        $users = User::all();
        $videos = Video::all();

        return view('admin.dashboard', [
            'numPlaylistViews' => $numPlaylistViews,
            'numUsers' => $numUsers,
            'numVideos' => $numVideos,
            'allTags' => $tags,
            'users' => $users,
            'videos' => $videos,
        ]);
    }

    public function login(Request $request)
    {
        if ($request->isMethod('get')) {
            if ($this->isLoggedIn($request)) return redirect('/admin');

            return view('admin.login');
        }

        $username = $request->input('username');
        $password = $request->input('password');

        if ($username === env('ADMIN_USERNAME') && $password === env('ADMIN_PASSWORD')) {
            $request->session()->put(self::$ADMIN_SESSION_KEY, true);
            return redirect()->action('AdminController@dashboard');
        }

        return redirect()->action('AdminController@login')->with('error', 'Invalid credentials');
    }

    public function logout(Request $request)
    {
        $request->session()->forget(self::$ADMIN_SESSION_KEY);
        return redirect()->action('AdminController@login');
    }

    public function addVideo(Request $request) {
        $request->validate([
            'url' => ['required', 'regex:/(youtube\.com\/watch\?v=.+)|(vimeo\.com\/.+)/'],
            'duration' => 'required|integer',
            'title' => 'required',
        ]);

        $video_data = Video::parseUrl($request->input('url'));

        $tags = Tag::whereIn('name', explode(',', $request->input('tags')))->get();

        $video = new Video;

        $video->graphic = $request->has('graphic');
        $video->length = $request->input('duration');
        $video->mature = $request->has('mature');
        $video->service = $video_data['service'];
        $video->service_video_id = $video_data['service_video_id'];
        $video->title = $request->input('title');
        $video->widescreen = $request->has('widescreen');

        $video->save();

        $video->tags()->attach($tags);

        return redirect()->action('AdminController@dashboard')->with('add_video_status', 'Video successfully added');
    }

    public function editVideo($videoId, Request $request) {
        $video = Video::find($videoId);

        $tags = Tag::all();

        return view('admin.edit-video', [
            'allTags' => $tags,
            'video' => $video,
        ]);
    }

    public function updateVideo($videoId, Request $request) {
        $request->validate([
            'url' => ['required', 'regex:/(youtube\.com\/watch\?v=.+)|(vimeo\.com\/.+)/'],
            'duration' => 'required|integer',
            'title' => 'required',
        ]);

        $video_data = Video::parseUrl($request->input('url'));

        $tags = Tag::whereIn('name', explode(',', $request->input('tags')))->get();

        $video = Video::find($videoId);

        $video->graphic = $request->has('graphic');
        $video->length = $request->input('duration');
        $video->mature = $request->has('mature');
        $video->service = $video_data['service'];
        $video->service_video_id = $video_data['service_video_id'];
        $video->title = $request->input('title');
        $video->widescreen = $request->has('widescreen');

        $existing_tags = $video->tags()->get();

        $deleted_tags = $existing_tags->diff($tags);
        $new_tags = $tags->diff($existing_tags);

        // HACK: These should not be here
        unset($video->src);
        unset($video->thumbnailSrc);

        $video->save();

        $video->tags()->detach($deleted_tags);
        $video->tags()->attach($new_tags);

        return redirect()->action('AdminController@editVideo', $videoId)->with('update_video_status', 'Video updated');
    }

    public function deleteUser($userId, Request $request) {
        $user = User::find($userId);
        $user->delete();
        return '';
    }

    public function deleteVideo($videoId, Request $request) {
        Video::destroy($videoId);
        return '';
    }

    private function isLoggedIn(Request $request) {
        return $request->session()->get(self::$ADMIN_SESSION_KEY, false) === true;
    }
}
