<template>
    <div class="internal-page">
        <div class="container">
            <!-- success message -->
            <div class="col-sm-12 text-center" v-if="confirmationMessage != '' ">
                <h1 class="message">{{confirmationMessage}}</h1>
            </div>
            <!-- reset password form -->
            <div class="row" v-if="showForm">
                <div class="col-sm-12">
                    <div class="title title2">
                        <h2>Reset Password</h2>
                        <p>Enter Your Data to Continue</p>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="layout1">
                            <p class="lead text-danger">{{successMessage}}</p>
                            <form>
                                <div class="form-group">
                                    <input type="Password" class="form-control the-input" placeholder="Enter Password"v-model="form.password" :class="{ 'is-invalid' : errors.password}">
                                </div>
                                <div class="form-group">
                                    <input type="Password" class="form-control the-input" placeholder="Confirm Password" v-model="form.password_confirmation">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn the-btn btn-block hvr-radial-out" @click.prevent="reset">Change Password</button>
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
        data() {
            return {
                confirmationMessage: '',
                form : {
                    password: '',
                    password_confirmation: ''
                },
                showForm: false,
                successMessage: ''
            }
        },
        mounted(){
            this.email = this.$route.params.email;
            this.token = this.$route.params.token;
            this.confirmReset();
        },
         methods: {
            confirmReset() {
                // send reset get request to server to confirm that record exist and has reminder
                this.$axios.get('auth/reset-password/' + this.email + '/' +  this.token)
                            .then( res => {
                               if( res.status == 200) {
                                    this.confirmationMessage = res.data.message
                                    // hide the message and show the reset form 
                                    setTimeout( 
                                       () => {
                                                this.confirmationMessage = '',
                                                this.showForm = true
                                            },
                                        2000
                                    );
                               }
                            })
                            .catch( error => {
                                $nuxt.error({
                                    statusCode: error.response.status,
                                    message: error.response.data.message
                                })
                            })
            },
            redirect() {
                setTimeout( () =>  this.$router.replace({name: 'index'}), 2500);
            },
            reset() {
                this.$axios.post('auth/reset-password/' + this.email + '/' +  this.token, this.form)
                           .then( res => {
                                this.successMessage = res.data.message
                                // then redirect home 
                                this.redirect()
                           })
            }
        }
    }
</script>