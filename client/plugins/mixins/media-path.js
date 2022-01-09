import Vue from 'vue'

const ImagesPath = {
    install(Vue, option) {
        Vue.mixin({
          methods: {
            imagePath: (image) => {
                try {
                    return require(`@/assets/${image}`);
                } catch {
                    return require('@/assets/img/no_image.jpg');
                }
            },
            videoPath: (video) => {
                try {
                    return require(`@/assets/${video}`);
                } catch(e) {
                    return require('@/assets/img/no_video.jpg');
                }
            }
          }
        })
    }
}

Vue.use(ImagesPath)