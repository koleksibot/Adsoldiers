<template>
    <div>
        <div class="fixed alert alert-danger" v-if="successMessage">{{successMessage}}</div>
        <settings :settings="settings"/>
    </div>
</template>

<script>
    import Settings  from '@/components/dashboard/settings'
    export default {
        data(){
            return{
                settings: '',
                successMessage: ''
            }
        },
        components: {
            Settings
        },
        async asyncData({app}){
            let response = await app.$axios.$get('/settings')
            return {
                settings: response.data
            }
        },
        methods: {
        },
        layout: 'dashboard',
        middleware: [
            'auth',
            'admin'
        ]
    }
</script>