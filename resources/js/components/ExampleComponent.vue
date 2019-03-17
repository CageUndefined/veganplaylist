<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
    $(function() {
        $('#name_input').keyup(function(){
            var name = $(this).val();
            console.log( name );
            return true;
            $.ajax({
                url: '/search/name/' + name,
                method: 'GET',
                success: function (resp) {
                    console.log('success!');
                    console.log(resp);
                },
                complete: function (resp) {
                    console.log('complete');
                }
            });

        });
    });
</script>
