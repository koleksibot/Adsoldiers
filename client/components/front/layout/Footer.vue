<template>
    <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        <img src="@/assets/img/logo.png" class="logo2">
                        <p>Call us now: {{contacts.mobile}}</p>
                        <p>Email: {{contacts.email}}</p>
                        <ul class="social">
                            <li><a :href="contacts.facebook" title="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a :href="contacts.twitter"  title="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a :href="contacts.instagram"  title="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 col-sm-4">
                        <h4>service</h4>
                        <ul class="links">
                            <li><a href="#">about us</a></li>
                            <li><a href="#">information</a></li>
                            <li><a href="#">privacy policy</a></li>
                            <li><a href="#">terms &amp; conditions </a></li>
                            <li><a href="#">privacy policy</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 col-sm-4">
                        <h4>extras</h4>
                        <ul class="links">
                            <li><a href="#">about us</a></li>
                            <li><a href="#">information</a></li>
                            <li><a href="#">privacy policy</a></li>
                            <li><a href="#">terms &amp; conditions </a></li>
                            <li><a href="#">privacy policy</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <h4>my account</h4>
                        <ul class="links">
                            <li><a href="#">about us</a></li>
                            <li><a href="#">information</a></li>
                            <li>
                                <router-link :to="{name : 'privacy'}">privacy policy</router-link>
                            </li>
                            <li><a href="#">terms &amp; conditions </a></li>
                            <li>
                                <router-link :to="{name : 'contact'}">Contact US</router-link>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <h4>download our app</h4>
                        <div class="apps">
                            <a href="#" title="app-store"><img src="~/assets/img/app1.png" alt="app-store"></a>
                            <a href="#" title="google-play"><img src="~/assets/img/app2.png" alt="google-play"></a>
                        </div>
                        <h4>subscription</h4>
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Email">
                                <div class="input-group-btn">
                                    <button class="btn the-btn1" type="submit">Subscripe</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</template>


<script>
export default {
    data () {
        return {
            contacts : []
        }
    },
    async asyncData({$axios}){
        let response = await $axios.$get('settings')
        return{
            contacts:response.data
        }
    },
}
</script>