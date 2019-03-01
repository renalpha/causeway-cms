<template>
    <div class="alert spacing" v-bind:class="flashMessage.type" role="alert" v-show="flashMessage.show">
        <strong>{{ flashMessage.title }}</strong><br/>
        {{ flashMessage.message }}
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Message mounted.');
        },
        data: function () {
            return {
                flashMessage: {
                    type: '',
                    title: '',
                    message: ''
                },
            };
        },

        methods: {
            flash(type, title, message) {
                this.flashMessage.show = true;
                this.flashMessage.type = type;
                this.flashMessage.title = title;
                this.flashMessage.message = message;
            },
            hide() {
                this.flashMessage.show = false;
            },
        }
    };
</script>
