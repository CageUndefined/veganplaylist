import './bootstrap'
import Tagify from '@yaireo/tagify'

window.onload = function() {
    setUpVideoForm()
    setUpUserList()
    setUpVideoList()
}

function setUpUserList() {
    document.querySelectorAll('button.delete-user').forEach(button => {
        button.addEventListener('click', onClickDeleteUser)
    })
}

function setUpVideoList() {
    document.querySelectorAll('button.delete-video').forEach(button => {
        button.addEventListener('click', onClickDeleteVideo)
    })
}

function onClickDeleteUser(e) {
    const userId = e.target.dataset.id
    const userEmail = e.target.dataset.email

    if (confirm(`Are you sure you want to delete ${userEmail}?`)) {
        window.axios
            .delete(`/users/${userId}`)
            .then(window.location.reload.bind(window.location))
            .catch(alert)
    }
}

function onClickDeleteVideo(e) {
    const videoId = e.target.dataset.id
    const videoTitle = e.target.dataset.title

    if (confirm(`Are you sure you want to delete ${videoTitle}?`)) {
        window.axios
            .delete(`/videos/${videoId}`)
            .then(window.location.reload.bind(window.location))
            .catch(alert)
    }
}

function setUpVideoForm() {
    const urlInput = document.querySelector('input#url')
    const tagInput = document.querySelector('input#tags')
    const tagValueInput = document.querySelector('input[name=tags]')

    urlInput.addEventListener('input', debounce(onUrlChange, 300))

    const tagify = new Tagify(tagInput, {
        enforceWhitelist: true,
    })

    tagify.on('add', e => {
        const tagName = e.detail.data.value

        tagValueInput.value = tagValueInput.value
            .split(',')
            .filter(t => t.length)
            .concat([tagName])
            .join(',')
    })

    tagify.on('remove', e => {
        const tagName = e.detail.data.value

        tagValueInput.value = tagValueInput.value
            .split(',')
            .filter(t => t.length && t !== tagName)
            .join(',')
    })
}

function onUrlChange(e) {
    let url = e.target.value
    const isVimeo = url.indexOf('vimeo.com') >= 0
    const isYouTube = url.indexOf('youtube.com') >= 0

    if (!isYouTube && !isVimeo) {
        updateForm({ duration: '', title: '' })
        return
    }

    if (url.indexOf('http') !== 0) {
        url = `https://${url}`
    }

    if (isVimeo) {
        fetchVimeoVideo(url)
            .then(r => r.json())
            .then(data => {
                const { duration, title } = data
                updateForm({ duration, title })
            })
            .catch(() => alert('Invalid Vimeo URL'))
    } else {
        fetchYouTubeVideo(url)
            .then(r => r.json())
            .then(data => {
                if (data.hasOwnProperty('error')) {
                    throw new Error(
                        data.error.errors.map(e => e.reason).join('\n'),
                    )
                }

                if (!(data.items && data.items.length)) {
                    throw new Error('video does not exist')
                }

                let {
                    snippet: { title },
                    contentDetails: { duration: durationStr },
                } = data.items[0]

                const duration = getSeconds(durationStr)

                updateForm({ duration, title })
            })
            .catch(e => {
                alert('Invalid YouTube URL: ' + e.message)

                updateForm({ duration: '', title: '' })
            })
    }
}

function updateForm({ duration, title }) {
    const durationInput = document.querySelector('input#duration')
    const titleInput = document.querySelector('input#title')

    durationInput.value = duration

    titleInput.disabled = title === ''
    titleInput.value = title
}

function debounce(func, wait, immediate) {
    let timeout
    return function() {
        const context = this,
            args = arguments
        const later = function() {
            timeout = null
            if (!immediate) func.apply(context, args)
        }
        const callNow = immediate && !timeout
        clearTimeout(timeout)
        timeout = setTimeout(later, wait)
        if (callNow) func.apply(context, args)
    }
}

function fetchVimeoVideo(url) {
    return fetch(`https://vimeo.com/api/oembed.json?url=${url}`)
}

function fetchYouTubeVideo(url) {
    const videoId = new URL(url).searchParams.get('v')

    return fetch(
        `https://www.googleapis.com/youtube/v3/videos?part=snippet,contentDetails&id=${videoId}&key=${
            window.MIX_YOUTUBE_API_KEY
        }`,
    )
}

function getSeconds(duration) {
    const iso8601DurationRegex = /(-)?P(?:([.,\d]+)Y)?(?:([.,\d]+)M)?(?:([.,\d]+)W)?(?:([.,\d]+)D)?(?:T(?:([.,\d]+)H)?(?:([.,\d]+)M)?(?:([.,\d]+)S)?)?/

    const matches = duration.match(iso8601DurationRegex)

    const weeks = matches[4] === undefined ? 0 : parseInt(matches[4]) // lol
    const days = matches[5] === undefined ? 0 : parseInt(matches[5]) // lol
    const hours = matches[6] === undefined ? 0 : parseInt(matches[6])
    const minutes = matches[7] === undefined ? 0 : parseInt(matches[7])
    const seconds = matches[8] === undefined ? 0 : parseInt(matches[8])

    return seconds + minutes * 60 + hours * 3600 + days * 86400 + weeks * 604800
}
