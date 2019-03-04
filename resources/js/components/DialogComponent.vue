<template>
    <div style="display: -webkit-inline-box;" class="vue-dialog">
        <a href="" class="btn btn-sm btn-danger" @click.prevent @click="showModal('warning', 'foo', 'bar')">
            Remove
        </a>

        <div class="modal-backdrop" v-show="modalDialog.show">
            <div class="modal fade">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <div name="header">
                                {{ modalDialog.title }}
                                <button type="button" class="btn-close" @click="closeModal">x</button>
                            </div>
                        </div>
                        <div class="modal-body">
                            <slot name="body">
                                {{ modalDialog.message }}
                            </slot>
                        </div>
                        <div class="modal-footer">
                            <slot name="footer">
                                <button type="button" class="btn-green" @click="closeModal">
                                    Close
                                </button>
                            </slot>
                        </div>
                    </div>
                </div>
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
