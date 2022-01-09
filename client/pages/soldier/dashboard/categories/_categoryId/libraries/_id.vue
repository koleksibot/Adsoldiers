<template>
  <library-title :library="library" />
</template>

<script>
  import LibraryTitle from '@/components/dashboard/libraries/categories/_id'

  export default{
    data() {
      return {
        library: [],
      }
    },
    components:{
      LibraryTitle
    },
    async asyncData({app, params, error}) {
        try {
            let response = await app.$axios.$get(`libraries/${params.id}`);
            return {
                library: response.data
            }
        } catch(e) {
           error({statusCode: e.status, message: e.message})
        }
    },
    layout: 'dashboard',
    middleware: 'auth'
  }
</script>