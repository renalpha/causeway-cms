<template>
    <form method="POST" :action="register_route" id="register-form" v-on:submit="registerPost">
        <input type="hidden" name="_token" :value="csrf_token" />

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" v-model="registerDetails.name" autofocus>
                <span v-if="formErrors.name" class="help-block text-danger">{{ formErrors.name[0] }}</span>
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">E-mail address</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" v-model="registerDetails.email">
                <span v-if="formErrors.email" class="help-block text-danger">{{ formErrors.email[0] }}</span>
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" v-model="registerDetails.password">
                <span v-if="formErrors.password" class="help-block text-danger">{{ formErrors.password[0] }}</span>
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Password confirm</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" v-model="registerDetails.password_confirmation">
                <span v-if="formErrors.password_confirmation" class="help-block text-danger">{{ formErrors.password_confirmation[0] }}</span>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Register
                </button>
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
                registerDetails: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
                formErrors: {}
            }
        },
        props: ['csrf_token', 'register_route', 'login_route'],

        methods: {
            registerPost: function (event) {

                let vm = this;

                event.preventDefault();

                // perform ajax
                axios.post('/register', vm.registerDetails)
                    .then(function (response) {
                        var result = response.data;

                        if (result.status === true) {
                            location.reload();
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
