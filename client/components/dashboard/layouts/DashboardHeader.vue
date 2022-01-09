<template>
	<div class="admin-header">
		<!-- Success Message -->
		<div :class="`alert ${successMessage_bg}`" v-if="successMessage">
			{{ successMessage }}
		</div>
		<!-- user image & name -->
		<nuxt-link :to="{ path: '/' + role + '/profile' }" class="user color1">
			<div>
				<img :src="'/_nuxt/assets/' + user.picture" alt="profile_pic" />
			</div>
			<p class="pull-right p-2 m-0 bold">{{ user.username }}</p>
		</nuxt-link>
		<!-- notifications -->
		<div class="notifications">
			<span class="notification-icon active">
				<i class="fa fa-bell"></i>
			</span>
			<div class="notification-content">
				<ul class="m-0">
					<li
						:class="{ 'bg-light': !notification.read_at }"
						v-for="notification in notifications.data"
						:key="notification.id"
						@click="readNotification(notification.id)"
					>
						<div>{{ notification.data.title }}</div>
						<div>
							<button
								class="the-btn hvr-radial-out"
								@click="subscribeAd(notification.data.id)"
							>
								Subscribe
							</button>
							<nuxt-link
								class="the-btn hvr-radial-out"
								:to="{
									name: 'ads-id-utm',
									params: { id: notification.data.id, utm: user.utm },
								}"
								>Preview</nuxt-link
							>
						</div>
					</li>
					<li class="read-more text-center" @click="loadMoreNotifications">
						Read More
					</li>
				</ul>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				successMessage: '',
				successMessage_bg: '',
			}
		},

		mounted() {
			this.toggleNotifications()
		},

		computed: {
			notifications: {
				get() {
					return this.$store.getters['notifications']
				},
				set(val) {
					this.$store.dispatch('setNotifications', val)
				},
			},
		},

		methods: {
			toggleNotifications() {
				$(function() {
					$('.notification-icon').click(function() {
						$('.notification-content').slideToggle()
					})
				})
			},
			subscribeAd(id) {
				this.$axios
					.$post(`ads/${id}/subscribe`)
					.then((res) => {
						this.successMessage = res.data.message
						this.successMessage_bg = 'alert-success'
					})
					.catch((err) => {
						this.successMessage = err.data.errors.message
						this.successMessage_bg = 'alert-danger'
					})
			},
			readNotification(id) {
				this.$axios
					.$post(`notifications/${id}`)
					.then((res) => {
						this.notifications = res
					})
					.catch((err) => {
						this.successMessage = err.message
						this.successMessage_bg = 'alert-danger'
					})
			},
			loadMoreNotifications() {
				this.$axios
					.$get(this.notifications.links.next_page_url)
					.then((res) => {
						this.notifications = res
					})
					.catch((err) => {
						console.log(err)
					})
			},
		},
	}
</script>
