<template>
    <div style="display: -webkit-inline-box;">
        <a href="" class="btn btn-sm btn-danger" @click="showModal('warning', 'foo', 'bar')">
            Remove
        </a>

        <div class="modal-backdrop" v-show="modalDialog.show">
            <div class="modal">
                <header class="modal-header">
                    <slot name="header">
                        {{ modalDialog.title }}
                        <button type="button" class="btn-close" @click="closeModal">x</button>
                    </slot>
                </header>
                <section class="modal-body">
                    <slot name="body">
                        {{ modalDialog.message }}
                    </slot>
                </section>
                <footer class="modal-footer">
                    <slot name="footer">
                        <button type="button" class="btn-green" @click="closeModal">
                            Close
                        </button>
                    </slot>
                </footer>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Dialog mounted.');
        },
        data: function () {
            return {
                modalDialog: {
                    type: '',
                    title: '',
                    message: '',
                    show: ''
                },
            };
        },

        methods: {
            showModal: function (type, title, message) {
                this.modalDialog.show = true;
                this.modalDialog.type = type;
                this.modalDialog.title = title;
                this.modalDialog.message = message;
            },
            closeModal: function () {
                this.modalDialog.show = false;
            }
        }
    };
</script>
