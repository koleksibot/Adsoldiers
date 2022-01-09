<template>
    <div>
        <!-- Libraries of this category -->
        <gallery :galleries="category.libraries" />
        <!-- pagination buttons -->
        <!-- prev -->
        <button class="btn btn-info" @click="prev" :disabled="this.prev_link == null">Previous</button>
        <!-- next -->
        <button class="btn btn-info" @click="next" :disabled="this.next_link == null">Next</button>
    </div>
</template>

<script>
    import Gallery from '@/components/dashboard/gallery'

    export default{
        data() {
            return {
                category: [],
                next_link: '',
                prev_link: '',
            }
        },
        methods: {
            next() {
                this.$axios.$get(`${this.category.libraries.links.next_page_url}`)
                    .then(
                        res => {
                            this.category = res.data,
                            this.next_link = this.category.libraries.links.next_page_url
                            this.prev_link = this.category.libraries.links.prev_page_url
                        }
                    ).catch( err => {
                        error({statusCode:err.status, message: err.message})
                    })
            },
            prev() {
                this.$axios.$get(`${this.category.libraries.links.prev_page_url}`)
                    .then(
                        res => {
                            this.category = res.data,
                            this.next_link = this.category.libraries.links.next_page_url
                            this.prev_link = this.category.libraries.links.prev_page_url
                        }
                    ).catch( err => {
                        error({statusCode:err.status, message: err.message})
                    })
            }
        },
        components: {
            Gallery
        },
        async asyncData({app, params, error}) {
            try {
                let response = await app.$axios.$get(`libraries/categories/${params.categoryId}`);
                return {
                    category: response.data,
                    next_link: response.data.libraries.links.next_page_url
                }
            } catch(e) {
               error({statusCode: e.status, message: e.message})
            }
        },
        layout: 'dashboard',
        middleware: [
          'auth',
          'admin'
        ]
    }
</script>