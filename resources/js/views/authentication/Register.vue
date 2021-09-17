<template>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content" style="margin-bottom: 50px !important;">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                <div class="card-body">
                                    <form v-on:submit.prevent="register">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" v-model="user.name" id="name" type="text" placeholder="Enter full name" />
                                                    <label for="name">Full name</label>
                                                    <div class="invalid-feedback" v-if="errors.name">{{errors.name[0]}}</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control" v-model="user.email" id="email" type="email" placeholder="Enter email" />
                                                    <label for="email">Email address</label>
                                                    <div class="invalid-feedback" v-if="errors.email">{{errors.email[0]}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" v-model="user.password" id="password" type="password" placeholder="Create a password" />
                                                    <label for="password">Password</label>
                                                    <div class="invalid-feedback" v-if="errors.password">{{errors.password[0]}}</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" v-model="user.password_confirmation" id="password_confirmation" type="password" placeholder="Confirm password" />
                                                    <label for="password_confirmation">Confirm Password</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary btn-block">Create Account</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <router-link to="/login" class="small">Have an account? Go to login</router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2021</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</template>

<script>
    import * as auth from '../../services/auth_service';
    export default {
        name: 'Register',
        created() {
            document.querySelector('body').style.backgroundColor = '#343a40';
        },
        data() {
            return {
                user: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                },
                errors: {}
            }
        },
        methods: {
            register: async function() {
                try {
                    await auth.register(this.user);
                    this.error = {};
                    this.$router.push('/login');
                } catch (error) {
                    switch (error.response.status) {
                        case 422:
                            this.errors = error.response.data.errors;
                            break;
                        case 500:
                            this.flashMessage.error({
                                message: error.response.data.message,
                                time: 5000
                            });
                            break;
                        default:
                            this.flashMessage.error({
                                message: 'Some error occurred, Please try again!',
                                time: 5000
                            });
                            break;
                    }
                }
            },
        },
    }
</script>