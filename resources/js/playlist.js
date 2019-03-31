/*
 *
 *  Dependencies and URL Query Params
 *
 */
require('./bootstrap')

import _ from 'lodash'
import Sortable from 'sortablejs'

const uri = window.location.search.substring(1)
const params = new URLSearchParams(uri)
const nameFromGetParams = params && params.get('name') ? params.get('name') : ''

/* Playlist
 *
 *  Define our Playlist object
 *
 */
const Playlist = {
    name: nameFromGetParams,
    action: 'create',

    init() {
        this.cancelRequest = _.noop

        if (this.name) $('#playlist_name').val(this.name)
        else this.name = $('#playlist_name').val()

        if (window.location.href.match(/edit\/?$/)) this.action = 'edit'

        const sortablePlaylist = document.querySelector(
            '#the_playlist ul.list-group',
        )
        if (sortablePlaylist) new Sortable(sortablePlaylist)

        // Build our playlist if it exists
        $('#the_playlist ul.list-group li').each(function(i, el) {
            var id_match = $(el)
                .attr('id')
                .match(/_(\d+)$/)
            var li_id = id_match[1]
            var li_title = $('#' + $(el).attr('id') + ' div.title').text()
        })

        this.bindEvents()
        return this
    },

    bindEvents() {
        $('#filter_form').on('submit', e => {
            e.preventDefault()
        })
        $('.search-results').on('click', '.btn-add', function() {
            const id = $(this).data('id')
            const title = $('#card_' + id + ' p').text()
            Playlist.addVideo(id, title)
            return false
        })
        $('#the_playlist ul.list-group').on('click', '.remove', function() {
            const id = $(this).data('id')

            Playlist.removeVideo(id)
            $('#list_item_' + id)
                .fadeOut()
                .remove()
            return false
        })
        $('.playlist-save').on('click', function() {
            $(this)
                .text('Saving…')
                .addClass('disabled')
                .attr('disabled', true)
            if (Playlist.action === 'create') {
                Playlist.createPlaylist()
            } else {
                Playlist.updatePlaylist()
            }
            return false
        })
    },

    filter() {
        this.cancelRequest()
        const $loadingIndicator = $('.loading-indicator')
        const $emptyState = $('.no-results')
        const $searchResults = $('.search-results')

        $searchResults.find('.video-card').remove()
        $emptyState.addClass('d-none')
        $loadingIndicator.removeClass('d-none')

        const labels = []
        $('#labels_active button').each(function(i, el) {
            labels.push($(el).data('id'))
        })
        const data = {
            title: $('#name_input').val(),
            hide_graphic: $('#graphic_input').is(':checked') ? 0 : 1,
            hide_mature: $('#mature_input').is(':checked') ? 0 : 1,
            tags: labels,
        }

        axios
            .post('/videolist', data, {
                cancelToken: new axios.CancelToken(
                    c => (this.cancelRequest = c),
                ),
            })
            .then(response => {
                $loadingIndicator.addClass('d-none')
                if (response && response.data) {
                    $searchResults.append(response.data)
                } else if (response.data === '') {
                    $emptyState.removeClass('d-none')
                }
            })
            .catch(error => {
                if (!axios.isCancel(error)) {
                    console.log(error)
                }
            })
    },

    addVideo(id, title) {
        axios
            .get('/video/' + id)
            .then(response => {
                const li = response.data
                const list = $('#the_playlist .list-group')
                list.append(li)
                $('#card_' + id).fadeOut()
                $('.playlist-save')
                    .removeClass('disabled')
                    .attr('disabled', false)
            })
            .catch(error => {
                console.log(error)
            })
    },

    removeVideo(id) {
        $('#card_' + id).show()
        if (!Playlist.getVideoIds())
            $('.playlist-save')
                .addClass('disabled')
                .attr('disabled', true)
    },

    createPlaylist() {
        const data = {
            name: $('#playlist_name').val(),
            video_ids: Playlist.getVideoIds(),
        }
        axios
            .post('/playlist', data)
            .then(response => {
                window.location = '/playlist/' + response.data.slug
            })
            .catch(error => {
                $('.playlist-save')
                    .text('Create Playlist')
                    .removeClass('disabled')
                    .attr('disabled', false)
                console.log(error)
                alert('Your playlist name may be taken already!')
            })
    },

    updatePlaylist() {
        var slug = $('#playlist_slug').val()
        var data = {
            slug: slug,
            name: $('#playlist_name').val(),
            video_ids: Playlist.getVideoIds(),
        }
        axios
            .put('/playlist/' + slug, data)
            .then(response => {
                window.location = '/playlist/' + slug
            })
            .catch(error => {
                console.log(error)
            })
    },

    getVideoIds() {
        return $('#the_playlist ul.list-group li')
            .map((i, v) => $(v).data('id'))
            .toArray()
    },
}

/*
 *
 * document ready
 *
 */
$(() => {
    window.Playlist = Playlist.init()

    const debouncedFilter = _.debounce(() => {
        Playlist.filter()
        return false
    }, 300)

    $('#name_input').on('input', debouncedFilter)
    $('input[type=checkbox]').on('change', debouncedFilter)
    $('#labels_inactive, #labels_active').on('click', 'a', e => {
        const el = e.target
        const nodeCp = $(el).clone()
        let targetGroup
        if (
            $(el)
                .parent()
                .attr('id')
                .match(/_active/)
        ) {
            targetGroup = $('#labels_inactive')
            nodeCp.addClass('badge-pill')
        } else {
            targetGroup = $('#labels_active')
            nodeCp.removeClass('badge-pill')
        }
        $(el).fadeOut('fast', () => {
            $(el).remove()
            targetGroup.append(nodeCp)
            Playlist.filter()
            return false
        })
    })
})
