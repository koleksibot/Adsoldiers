import Vue from 'vue'
import { mapGetters } from 'vuex'

const User = {
    install(Vue, option) {
        Vue.mixin({
            computed: {
                ...mapGetters({
                    user: 'user',
                    role: 'role',
                    authenticated: 'authenticated',
                })
            }
        })
    }
}

Vue.use(User)