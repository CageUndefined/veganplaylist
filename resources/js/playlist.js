
/*
*
*  Dependencies and URL Query Params
*
*/
require('./bootstrap')

var uri = window.location.search.substring(1);
var params = new URLSearchParams(uri);
var name_from_get_param = (params && params.get('name')) ? params.get('name') : '';


/* Playlist
*
*  Define our Playlist object
*
*/
var Playlist = {

    name: name_from_get_param,
    list: {},

    init: function () {
        if ($('#playlist_name').length && this.name.length) $('#playlist_name').text( this.name );
        this.bindEvents();
        return this;
    },

    bindEvents: function () {
        $('.card-columns').on('click', '.btn-add', function(){
            var id = $(this).data('id');
            var title = $('#card_'+id+' p').text();
            Playlist.addVideo(id, title);
            return false;
        });
        $('ol.list-group').on('click', '.remove', function(){
            var id = $(this).data('id');
            Playlist.removeVideo(id);
            $(this).parent().fadeOut().remove();
            return false;
        });
        $('.playlist-save').click(function(){
            Playlist.createPlaylist();
            // go to viewer
            return false;
        });
    },

    filter: function() {
        var title        = $('#name_input').val();
        var hide_graphic = $('#graphic_input').is(":checked") ? 0 : 1;
        var hide_mature  = $('#mature_input').is(":checked")  ? 0 : 1;
        var data = {
            title: title,
            hide_graphic: hide_graphic,
            hide_mature: hide_mature,
            tags: []
        };
        console.log(data);
        axios.post('/videolist', data)
            .then(function (response) {
                if (response && response.data) {
                    if ($('.video-card').length) {
                        $('.video-card').fadeOut('fast', function(){
                            $('.video-card').detach();
                            $( response.data ).appendTo('.card-columns');
                        }).fadeIn();
                    }
                    else {
                        $( response.data ).appendTo('.card-columns');
                    }
                }
                else if (response.data === '') {
                    $('.video-card').detach();
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    },

    addVideo: function( id, title ) {
        var list = $('#new_playlist .list-group');
        // this should ideally be in some kind of template (handlebars)
        var li = '<li class="list-group-item">'+title+' <a href="#" data-id="'+id+'" class="remove text-danger ml-2"><i class="fas fa-trash-alt"></i></a></li>';
        list.append(li);
        Playlist.list[id] = {
            id: id,
            title: title
        };
        $('#card_'+id).fadeOut().remove();
        if ($('a.playlist-save').hasClass('disabled')) $('a.playlist-save').removeClass('disabled');
    },

    removeVideo: function( id ) {
        delete Playlist.list[id];
        $('a.playlist-save')
        $('#name_input').trigger('keyup');
        if (!Object.keys(Playlist.list).length) $('a.playlist-save').addClass('disabled');
    },

    createPlaylist: function() {
        console.log('create playlist ...');
        // axios.post('/playlist').then(function(response){}).catch(function(error){});
    }
};


/*
*
* document ready
*
*/
$(function() {

    window.Playlist = Playlist.init();

    $('#name_input').keyup(function(){
        Playlist.filter();
        return false;
    });
    $('input[type=checkbox]').change(function(){
        Playlist.filter();
        return false;
    });

});
