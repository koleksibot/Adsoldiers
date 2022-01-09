<template>
	<div>
		<!-- create and search  -->
		<div class="div-top">
			<nuxt-link
				:to="{ path: 'libraries/new' }"
				class="the-btn hvr-radial-out"
				v-if="role == 'admin'"
				>Create New</nuxt-link
			>
			<div class="the-search">
				<form>
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search" />
						<div class="input-group-btn">
							<button class="btn btn-default" type="submit">
								<img src="img/search.png" />
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- main page -->
		<gallery :galleries="category.libraries" />
	</div>
</template>

<script>
	import Gallery from '@/components/dashboard/gallery'

	export default {
		data() {
			return {
				category: [],
			}
		},
		components: {
			Gallery,
		},
		async asyncData({ app, params, error }) {
			try {
				let response = await app.$axios.$get(
					`libraries/categories/${params.name}`
				)
				return {
					category: response.data,
				}
			} catch (e) {
				error({ statusCode: e.status, message: e.message })
			}
		},
		layout: 'dashboard',
		middleware: ['auth', 'admin'],
	}
</script>
