<template>
    <form method="POST" :action="login_route" id="login-form" v-on:submit="loginPost">
        <input type="hidden" name="_token" :value=csrf_token />
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">E-mail address</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" v-model="loginDetails.email" autofocus>
                <span v-if="formErrors.email" class="help-block text-danger">{{ formErrors.email[0] }}</span>
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" v-model="loginDetails.password">
                <span v-if="formErrors.password" class="help-block text-danger">{{ formErrors.password[0] }}</span>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">

                    <label class="form-check-label" for="remember">
                        Remember me?
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Login
                </button>

                <a class="btn btn-link" :href="request_password_route">
                    Forgot password?
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
                loginDetails: {
                    email: '',
                    password: ''
                },
                formErrors: {}
            }
        },
        props: ['csrf_token', 'login_route', 'request_password_route'],

        methods: {
            loginPost: function (event) {

                let vm = this;

                event.preventDefault();

                // perform ajax
                axios.post('/login', vm.loginDetails)
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
