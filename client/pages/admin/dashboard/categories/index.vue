<template>
    <libraries-categories-index :librariesCategories="librariesCategories" />
</template>

<script>
    import librariesCategoriesIndex from '@/components/dashboard/libraries/categories/index'

    export default{
        data() {
            return {
                librariesCategories:[]
            }
        },
        components:{
            librariesCategoriesIndex
        },
        async asyncData({app}) {
            let response = await app.$axios.$get('libraries/categories')
            return {
                librariesCategories: response.data
            }
        },
        layout: 'dashboard',
        middleware: [
            'auth',
            'admin'
        ]
    }
</script>