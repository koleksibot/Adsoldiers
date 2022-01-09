<template>
    <div>
        <client-ony placeholder="Loading...">
           <v-client-table :data="tableData" :columns="columns" :options="options">
           </v-client-table>
        </client-ony>
    </div>
</template>

<script>
    export default {
        props: [
            'tasks'
        ],
        data() {
            return {
                    userTaskLvl: this.user,
                    columns: [ 'title', 'description', 'media'],
                    tableData:this.tasks,
                    options: {
                         templates: {
                            title:  function(h, row, index) {
                                // If User is admin
                                 if (this.role == 'admin') {
                                    return <a class="link2" href={'tasks/' + row.id }>{row.title}</a>
                                } else if (this.user.tasks_lvl > row.id) {
                                   // if user has made this task disable it's link
                                    return  <p>{row.title}</p>;
                                }
                                return <a class="link2" href={'tasks/' + row.id}>{row.title}</a>;
                            },
                            media: function(h, row, index) {
                               if (this.user.tasks_lvl > row.id){
                                    return 'Done';
                                }
                                return 'Active Task'
                            }
                        }
                    }
            }
        }
    }
</script>