<template>
    <div>
        <!-- Liberaries -->
        <div class="row">
            <div class="col-md-12">
                <div class="no-mar">
                    <div 
                        class="col-sm-6 col-md-3 no-padd ad-wrap" 
                        v-for="category in librariesCategories"
                        :key="category.id"
                    >
                        <nuxt-link :to="categoryLink(category.id)">
                            <img :src="imagePath(category.cover_img)" alt="ad1">
                            <h3>{{category.name}}</h3>
                        </nuxt-link>
                    </div>
                    <div class="col-sm-6 col-md-3 no-padd">
                        <div class="ad-wrap">
                            <h3 class="soon">Soon</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'librariesCategories'
        ],
        data() {
            return {
        
            }
        },
        methods: {
            categoryLink(id) {
                return {
                    path: `categories/${id}/libraries`,
                    params: {
                        categoryId: id
                    } 
                }
            }
        }, 
    }
</script>