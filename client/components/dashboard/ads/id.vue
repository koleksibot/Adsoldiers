<template>
	<div class="container">
		<!-- if media type is image -->
		<div
			v-if="(ad.media && ad.media_type == 'image') || 'slider'"
			v-for="media in ad.media"
			class="col-xs-6 col-md-4 img-box"
		>
			<img :src="imagePath(media)" class="thumbnail" />
		</div>
		<!-- if media type is video -->
		<template v-if="ad.media_type == 'video'">
			{{ ad.media }}
			<template v-if="!videoPath(ad.media[0]).includes('mp4')">
				<img :src="videoPath(ad.media[0])" />
			</template>
			<video
				:src="videoPath(ad.media[0])"
				controls
				v-else
				v-for="media in ad.media"
			></video>
		</template>
		<!-- content -->
		<div class="row mt-30">
			<div class="col-sm-11">
				<p class="white-box lead">{{ ad.content }}</p>
			</div>
		</div>
		<!-- utm button -->
		<button
			class="the-btn hvr-radial-out mb-20"
			@click.prevent="showUTM = !showUTM"
		>
			Get The Referral Link
		</button>
		<!-- What's app button -->
		<a
			:href="
				'https://api.whatsapp.com/send?text=' +
					this.ad.title +
					'%0A' +
					this.ad.content +
					'%0A' +
					referralLink
			"
			class="btn mb-20"
			target="_blank"
		>
			<img src="~/assets/img/whatsapp.png" class="icon" />
		</a>
		<!-- utm Token-->
		<div class="row">
			<div class="col-sm-11">
				<p v-if="showUTM" class="white-box h4">{{ referralLink }}</p>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		// head:{
		//   script: [
		//     {
		//       src: "/dist/vue-social-sharing.js",
		//       type: "text/javascript"
		//     }
		//   ]
		// },

		props: ['ad'],

		data() {
			return {
				showUTM: false,
			}
		},

		computed: {
			referralLink() {
				return (
					'http://www.vi.hit/ads' +
					this.$route.path.substring(this.$route.path.lastIndexOf('/')) +
					'/' +
					this.user.utm
				)
			},
			sharedAd() {
				return (
					this.referralLink +
					`fsdfafasdfasdf
      dasdasd: asdasdds      sadasddasdasdas`
				)
			},
		},
	}
</script>

<style scoped>
	video,
	img {
		max-width: 800px;
	}
	.icon {
		width: 197px;
		height: 99px;
		margin: -37px;
	}
</style>
