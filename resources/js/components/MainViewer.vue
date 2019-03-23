<template>
    <div>
    	{{ currentVideo.id }}
    </div>
</template>
<script>
    export default {
    	props: ['videos'],
    	data: function () {
    		this.currentVideo = JSON.parse(this.videos)[0];
    	}
    }
</script>
