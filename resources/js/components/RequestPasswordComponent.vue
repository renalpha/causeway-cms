<template>
    <form method="POST" :action="request_password_route" v-on:submit="requestPasswordPost">
        <input type="hidden" name="_token" :value="csrf_token" />

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">E-mail address</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" v-model="requestPasswordDetails.email" autofocus>
                <span v-if="formErrors.email" class="help-block text-danger">{{ formErrors.email[0] }}</span>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Request password
                </button>

                <a class="btn btn-link" :href="login_route">
                    Login
                </a>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data: function () {
            return {
                requestPasswordDetails: {
                    email: ''
                },
                formErrors: {}
            }
        },
        props: ['csrf_token', 'login_route', 'request_password_route'],

        methods: {
            requestPasswordPost: function (event) {

                let vm = this;

                event.preventDefault();

                // perform ajax
                axios.post(this.request_password_route, vm.requestPasswordDetails)
                    .then(function (response) {
                        var result = response.data;

                        if (result.status === true) {
                            console.log(result.message);
                        }
                    })
                    .catch(function (error) {
                        var errors = error.response.data;
                        vm.formErrors = errors.errors;
                    });
            }
        }
    }
</script>
