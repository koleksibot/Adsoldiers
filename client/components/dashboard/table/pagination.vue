<template>
	<div class="text-center">
		<ul class="pagination">
			<!-- prev -->
			<li :class="{ disabled: this.prev_link == null }">
				<a @click="prev">
					<i class="fa fa-backward"></i>
				</a>
			</li>
			<!-- pages buttons -->
			<li class="disabled">
				<a>..</a>
			</li>
			<li v-if="current_page !== 1">
				<a @click.prevent="prev">{{ current_page - 1 }}</a>
			</li>
			<li class="active">
				<a>
					{{ current_page }}
					<span class="sr-only">(current)</span>
				</a>
			</li>
			<li v-if="current_page != last_page">
				<a @click.prevent="next">{{ current_page + 1 }}</a>
			</li>
			<li class="disabled">
				<a>..</a>
			</li>
			<!-- next -->
			<li :class="{ disabled: this.next_link == null }">
				<a @click.prevent="next">
					<i class="fa fa-forward"></i>
				</a>
			</li>
		</ul>
	</div>
</template>

<script>
	// import { link } from 'fs'

	export default {
		data() {
			return {
				next_link: null,
				prev_link: null,
			}
		},
		props: ['links'],
		methods: {
			next(event) {
				if (this.links.next_page_url == null) return

				this.$axios
					.$get(`${this.links.next_page_url}`)
					.then((res) => {
						this.$emit('changePage', res.data)
						this.next_link = res.data.links.next_page_url
						this.prev_link = res.data.links.prev_page_url
					})
					.catch((err) => {
						$nuxt.error({ statusCode: err.status, message: err.message })
					})
			},
			prev() {
				if (this.links.prev_page_url == null) return

				this.$axios
					.$get(`${this.links.prev_page_url}`)
					.then((res) => {
						this.$emit('changePage', res.data)
						this.next_link = res.data.links.next_page_url
						this.prev_link = res.data.links.prev_page_url
					})
					.catch((err) => {
						$nuxt.error({ statusCode: err.status, message: err.message })
					})
			},
		},
		computed: {
			current_page() {
				return this.links ? this.links.current_page : 1
			},
			last_page() {
				return this.links ? this.links.last_page : 1
			},
		},
	}
</script>
