<template>
    <div>
        <div class="pull-right">
            <nuxt-link :to="{ name: 'admin-dashboard-users-create' }" class="the-btn hvr-radial-out">Create User</nuxt-link>
        </div>
        <client-only placeholder="Loading...">
           <v-client-table :data="tableData" :columns="columns" :options="options"></v-client-table>
        </client-only>
    </div>
</template>

<script>
    export default{
        data() {
            return {
                    columns: ['username', 'email', 'role'],
                    tableData: [],
                     options: {
                         templates: {
                            username: function(h, row, index) {
                                return <a href={"users/" + row.id}>{row.username}</a>
                            }
                        }
                    }
            }
        },
        async asyncData({app}) {
            let response = await app.$axios.$get('users')
            return {
                tableData: response.data
            }
        },
        layout: 'dashboard',
        'middleware': [
            'auth',
            'admin'
        ]
    }
</script>