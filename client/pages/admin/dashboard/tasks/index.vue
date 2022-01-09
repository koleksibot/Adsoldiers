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
        async asyncData({app}) {
            let response = await app.$axios.$get('tasks')
            return {
                tasks: response.data
            }
        },
        layout: 'dashboard',
        middleware: [
            'auth',
            'admin'
        ]
    }
</script>