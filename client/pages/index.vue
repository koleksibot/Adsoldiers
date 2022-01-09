<template>
	<div>
		<!-- start slider -->
		<slider></slider>
		<!-- end slider -->

		<!-- start services -->
		<services></services>
		<!-- end services -->

		<!-- start video -->
		<div class="video">
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<video-card
							thumbnail="_nuxt/assets/img/video1.png"
							:videoUrl="'https://www.youtube.com/embed/yRAzlw4JM8o'"
						></video-card>
						<h3>I'm An Advertiser</h3>
						<p class="text2">
							I Want To Increase My E-Commerce Sales, Influence And
							Profitability
						</p>
						<a href="#" class="the-btn hvr-radial-out">Join Team</a>
					</div>
					<div class="col-sm-6">
						<video-card
							thumbnail="_nuxt/assets/img/video1.png"
							:videoUrl="'https://www.youtube.com/embed/yRAzlw4JM8o'"
						></video-card>
						<h3>I'm A Publisher</h3>
						<p class="text2">
							I Want To Monetize My Online Traffic - Site, Blog or Social Assets
							- To Maximize
						</p>
						<a href="#" class="the-btn hvr-radial-out">Join Team</a>
					</div>
				</div>
			</div>
		</div>
		<!-- end video -->
		<!-- start clients -->
		<clients></clients>
		<!-- end clients -->
	</div>
</template>

<style>
	.video-img .shadow img {
		margin-top: 22%;
	}
</style>

<script>
	// import Home components
	import Slider from '@/components/front/home/Slider'
	import Services from '@/components/front/home/Services'
	import VideoCard from '@/components/front/home/VideoCard'
	import Clients from '@/components/front/home/Clients'

	export default {
		components: {
			Slider,
			Services,
			VideoCard,
			Clients,
		},
		mounted() {},
	}
</script>
