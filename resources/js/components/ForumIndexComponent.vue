<template>
<div></div>
</template>


<script>
    import Message from './MessageComponent.vue';
    import ClipLoader from 'vue-spinner/src/ClipLoader.vue';

    export default {
        mounted() {
            console.log('Forum index mounted.')
        },
        components: {
            Message
        },
        data: function () {
            return {
                loginDetails: {
                    email: '',
                    password: ''
                },
            }
        },
        created() {
            if (this.message) {
                this.flash(this.message)
            }
        },
        props: [],

        methods: {

        }
    }
</script>
