<template>
    <gallery :galleries="category.libraries" />
</template>

<script>
    import Gallery from '@/components/dashboard/gallery'

    export default{
        data() {
            return {
                category: [],
            }
        },
        components: {
            Gallery
        },
        async asyncData({app, params, error}) {
            try {
                let response = await app.$axios.$get(`libraries/categories/${params.name}`);
                return {
                    category: response.data
                }
            } catch(e) {
               error({statusCode: e.status, message: e.message})
            }
        },
        layout: 'dashboard',
        middleware: 'auth'
    }
</script>