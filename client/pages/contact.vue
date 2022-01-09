<template>
	<div>
		<!-- start page-title -->
		<div class="page-title">
			<div class="container">
				<ul
					:class="
						`${this.$i18n.locale == 'ar' ? 'breadcrumb-ar' : 'breadcrumb'}`
					"
				>
					<li>
						<a href="#"><img src="~/assets/img/home.png" />Home</a>
					</li>
					<li class="active">Page Name</li>
				</ul>
			</div>
		</div>
		<!-- end page-title -->
		<!-- start internal page -->
		<div class="internal-page">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="title title2">
							<h2>Contact Us</h2>
							<p>You can contact us anytime</p>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="contact-block">
							<i class="fa fa-map-marker" aria-hidden="true"></i>
							<p>{{ contacts.address }}</p>
							<span></span>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="contact-block">
							<i class="fa fa-envelope" aria-hidden="true"></i>
							<p>{{ contacts.email }}</p>
							<span></span>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="contact-block">
							<i class="fa fa-phone" aria-hidden="true"></i>
							<p>{{ contacts.mobile }}</p>
							<span></span>
						</div>
					</div>
					<!-- start map -->
					<div class="col-md-6 col-sm-12 mt-50">
						<GmapMap
							:center="center"
							:zoom="20"
							map-type-id="terrain"
							style="width: 100%; height: 450px"
						>
							<GmapMarker
								:key="index"
								v-for="(m, index) in markers"
								:position="m.position"
								:clickable="true"
								:draggable="true"
								@click="center = m.position"
								:icon="{ url: require('~/assets/img/map.png') }"
							/>
						</GmapMap>
					</div>
					<!-- end map -->
					<div class="col-md-6 col-sm-12 mt-50">
						<p class="text-danger">{{ successMessage }}</p>
						<form>
							<div class="form-group col-md-12 col-sm-6">
								<input
									type="text"
									class="form-control the-input"
									placeholder="Enter Name"
									v-model="form.name"
									:class="{ 'is-invalid': errors.name }"
								/>
							</div>
							<div class="form-group col-md-12 col-sm-6">
								<input
									type="email"
									class="form-control the-input"
									:class="{ 'is-invalid': errors.email }"
									placeholder="Your Email"
									v-model="form.email"
								/>
							</div>
							<div class="form-group col-md-12 col-sm-12">
								<input
									type="text"
									class="form-control the-input"
									placeholder="Enter Subject"
									v-model="form.subject"
									:class="{ 'is-invalid': errors.subject }"
								/>
							</div>
							<div class="form-group form-group3 col-md-12 col-sm-12">
								<textarea
									class="form-control the-input"
									placeholder="Enter Message"
									rows="10"
									v-model="form.message"
									:class="{ 'is-invalid': errors.message }"
								></textarea>
							</div>
							<div class="form-group col-md-12 col-sm-12">
								<button
									class="btn the-btn hvr-radial-out"
									@click.prevent="handleSubmition"
								>
									Send Message
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- end internal page -->
		<!-- start clients -->
		<clients></clients>
		<!-- end clients -->
	</div>
</template>

<script>
	// Import video clients from home components
	import Clients from '@/components/front/home/Clients'

	export default {
		data() {
			return {
				form: {
					name: '',
					email: '',
					subject: '',
					message: '',
				},
				successMessage: '',
				contacts: [],
				center: 0,
				markers: 0,
			}
		},
		components: {
			Clients,
		},
		mounted() {
			// scroll to the top of the page
			window.scrollTo(0, 0)
		},
		methods: {
			// Handeling submition of the form
			handleSubmition() {
				let response = this.$axios.post('contact', this.form).then((res) => {
					this.successMessage = res.data.message
				})
			},
		},
		async asyncData({ $axios }) {
			let response = await $axios.$get('settings')
			let contacts = response.data
			let icon = '~/assets/img/map.png'
			return {
				contacts: contacts,
				center: {
					lat: parseFloat(contacts.lat),
					lng: parseFloat(contacts.lng),
				},
				markers: {
					marker: {
						position: {
							lat: parseFloat(contacts.lat),
							lng: parseFloat(contacts.lng),
						},
					},
				},
			}
		},
	}
</script>
