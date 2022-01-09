<template>
   <div class="internal-page">
       <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="title title2">
                        <h2>Login</h2>
                        <p>Enter Your Data to Continue</p>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="layout1">
                            <form action="#" v-on:submit.prevent="login">
                                <div class="form-group">
                                    <input :class="{ 'is-invalid' : errors.email }" type="text" class="form-control the-input" placeholder="Enter Your Email" v-model="form.email">
                                </div>

                                <div class="form-group">
                                    <input :class=" { 'is-invalid' : errors.password} " type="password" class="form-control the-input" placeholder="Enter password" v-model="form.password">
                                </div>
                                <div class="checkbox form-group2">
                                    <label><input type="checkbox"> Remember me</label>
                                    <nuxt-link :to="{ name: 'auth-forget'}" class="forgot">Forgot Password !</nuxt-link>
                                </div>
                                <div class="form-group">
                                    <button class="btn the-btn btn-block hvr-radial-out">
                                        Login
                                    </button>
                                </div>
                                <div class="form-group text-center">
                                    <p class="color2">Don’t have an account ? <nuxt-link :to="{name: 'auth-register'}" class="color1">Sign up</nuxt-link></p>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div> 
   </div>
</template>

<script>
    export default {
        data(){
            return {
                form: {
                    email: '',
                    password: ''
                }
            }
        },
        methods: {
             login() {
                 this.$auth.loginWith('local', {
                  data: this.form
                })
            }
        }
    }
</script>