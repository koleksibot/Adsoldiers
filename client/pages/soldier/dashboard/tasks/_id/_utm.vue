<template>
    <single-task :task="task" />
</template>
<script>
    import SingleTask from '@/components/dashboard/tasks/_id'

    export default{
        data() {
            return {
                task: []
            }
        },
        components:{
            SingleTask
        },
        async asyncData({app, params}) {
              let response = await app.$axios.$get(`tasks/${params.id}`);
            return {
                task: response.data
            }
        },
        layout: 'dashboard',
        middleware: 'auth'
    }
</script>