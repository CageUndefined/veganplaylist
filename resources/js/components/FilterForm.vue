<template>
    <form id='filter_form'>
        <div class="row ml-2">
            <div class="col-sm-4">
                <div class="row">

                    <NameInputText
                        v-model="name_value"
                        placeholder="Search by name"
                        @keyup="searchName"
                    ></NameInputText>

                </div>
                <div class="row mt-2">
                    <div class="col-sm-2" title="Content that is stomach-turning">
                        <label for="graphic-input">Graphic:</label>
                    </div>
                    <div class="col-sm-1">
                        <input type="checkbox" id="graphic-input" checked />
                    </div>
                    <div class="col-sm-2" title="Content with language/nudity/violence">
                        <label for="nsfw-input">NSFW:</label>
                    </div>
                    <div class="col-sm-1">
                        <input type="checkbox" id="nsfw-input" checked />
                    </div>
                </div>
            </div>
            <div id="tags" class="col mr-2">
                <div class="row mb-3 mt-2 justify-content-end">
                    <div id="labels-inactive" class="">
                        <span
                            class="text-secondary mr-2"
                        >Tags: </span>
                            <!-- v-if="tags.length" -->

			            <!-- <TagItem
				            v-for="tag in tags"
				            v-bind:key="tag.id"
				            v-bind:tag="tag"
				            @remove="removeTag"
			            />

		                <p v-else>
			                No tags available.
		                </p> -->

                        <a href="#" class="badge badge-pill badge-primary">Ethics</a>
                        <a href="#" class="badge badge-pill badge-secondary">Humor</a>
                        <a href="#" class="badge badge-pill badge-success">Environment</a>
                        <a href="#" class="badge badge-pill badge-danger">Health</a>
                        <a href="#" class="badge badge-pill badge-primary">Inspiring</a>
                        <a href="#" class="badge badge-pill badge-warning">Documentary</a>
                        <a href="#" class="badge badge-pill badge-info">Information</a>
                        <!-- <a href="#" class="badge badge-pill badge-success">Fitness</a> -->
                        <a href="#" class="badge badge-pill badge-dark">Activism</a>
                        <a href="#" class="badge badge-pill badge-light">Speech</a>
                        <a href="#" class="badge badge-pill badge-warning">Music</a>
                        <a href="#" class="badge badge-pill badge-danger">Recipes</a>
                        <!-- <a href="#" class="badge badge-pill badge-secondary">Science</a> -->
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div id="labels-active">
                        <a href="#" class="badge badge-secondary">Science | x</a>
                        <a href="#" class="badge badge-success">Fitness | x</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    import NameInputText from './NameInputText.vue'
    import TagItem from './TagItem.vue'

    export default {
        components: {
            NameInputText,
            TagItem
        },
        data() {
            return {
                name_value: ''
            }
        },
        methods: {
            searchName() {
                const trimmedText = this.name_value.trim()
                if (trimmedText && trimmedText.length && trimmedText.length > 2) {
                    axios.get('/api/search/title/' + trimmedText)
                        .then(function (response) {
                            // handle success
                            console.log(response);
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        })
                        .then(function () {
                            // always executed
                        });
                }
            }
        }
    }

</script>
