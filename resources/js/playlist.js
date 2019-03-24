

var uri = window.location.search.substring(1);
var params = new URLSearchParams(uri);

var playlist = {
    name: (params) ? params.get('name') : ''
};


$(function() {
    console.log('page loaded!');
    console.log(playlist.name);

});