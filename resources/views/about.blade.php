@extends('layouts.page')

@section('title', 'About VeganPlaylist.org')

@section('page_content')
    <div class="container">
        <div class="card">
            <div class="card-body">
               <b style="font-size: 20px;">About VeganPlaylist.org</b>
			   <br><br>
			   <img src="https://i.imgur.com/5GXpofV.png" style="width:100%">
			   <br><br>
			   <b style="font-size: 16px;">Create a customized Vegan playlist for your friends or family!</b><br><br> If you have someone in mind and you'd like to introduce them to Veganism, normally you'll just send them the best video(s) that helped you transition first.
			   Finding the right video, the "best video", the one you think will have the most impact, is often pretty hard. Vegan Playlist allows you to customize and build a playlist of Vegan videos that you think will be the most impactful to share to your friends or family!
			   <br><br>
			   For example, if your friend relates more to the enviromental aspects, create a custom playlist and add videos that you think will have the most impact! If your friend is just learning how to cook, use our search to find 5 minutes recipe videos and create a playlist that has their favorite veganized foods!
			   <br><br>
			   <b style="font-size: 16px;">Use our premade Vegan playlists for research and entertainment!</b><br><br>
			   We've gone ahead and pre-built several playlists that have our "must watch" videos inside! Some of our playlists include the best vegan speeches, documentaries, debates, sketches, guides and activism! If you're already Vegan but want to brush up on your knoweldge, find a playlist and enjoy!
			   <br><br>
			    <b style="font-size: 16px;">Creating and sharing playlists gives you impact statistics!</b><br><br>
			   If you create your own playlist and share it with your friends, family, or the world, we'll collect anonymous data for you on that list to let you know what sort of impact you're making! All of our videos are pre-approved by the team, if you have suggestions for other videos to be added, please <a target=_blank href="https://youaretheirvoice.com/contact?veganplaylist">contact us</a> here!
			   <br><br>
			   <b style="font-size: 16px;">Thank you so much for visiting VeganPlaylist.org! Can you help us?</b><br><br>
			   Please spread the word by sharing our page below! If you're feeling extra generous, please <a href="https://www.patreon.com/veganhacktivists" target="_blank">check out our Patreon here</a> to support this project and other ones to come! All donations are used to fund future vegan projects (such as <a href="https://veganactivism.org" target="_blank">VeganActivism.org</a>), we'd be beyond grateful for even the smallest of contributions. Thank you!
			   <br><br>
			   <div data-url="{{ URL::to('/') }}" data-title="Vegan Playlist" class="sharethis-inline-share-buttons"></div>
            </div>
        </div>
        <br><br>

    </div>
@endsection
