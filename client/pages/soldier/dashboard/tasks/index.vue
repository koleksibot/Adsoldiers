<template>
    <task-index :tasks="tasks" />
</template>

<script>
    import TaskIndex from '@/components/dashboard/tasks/index'

    export default{
        data() {
            return {
                tasks:[]
            }
        },
        components:{
            TaskIndex
        },
        layout: 'dashboard',
        middleware: [
            'auth'
        ],
        mounted() {
            // fetch user data again to check his tasks level
            this.$auth.fetchUser()
        },
        async asyncData({app}) {
            let response = await app.$axios.$get('tasks')
            return {
                tasks: response.data
            }
        },
    }
</script>