<template>
	<div class="row">
		<div>{{ user }}</div>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				user: '',
			}
		},
		layout: 'dashboard',
		middleware: ['auth', 'admin'],
		async asyncData({ app, params }) {
			let response = await app.$axios.$get(`auth/profile/${params.id}`)
			return {
				user: response.data,
			}
		},
	}
</script>
