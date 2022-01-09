<template>
    <div class="internal-page">
        <div class="container text-center">
            <div class="col-sm-12">
                <p class="lead info-message">
                    {{message}}
                </p>
                <div class="col-sm-4 col-sm-offset-4">
                    <a :href="'https://' + email" class="btn the-btn btn-block hvr-radial-out">
                        Take me to my E-mail
                    </a>
                </div>
            </div>   
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return {
                message: '',
                email: '',
            }
        },
        mounted() {
            // if user refresh the page redirect home
           if (!this.$route.params.data) {
                this.$router.push('/')
                return;
            }
            this.message = this.$route.params.data.message;
            this.email = this.$route.params.data.email;
        }
    }
</script>