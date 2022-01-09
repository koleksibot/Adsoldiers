<template>
	<div>
		<!-- start wrapper -->
		<div class="admin-wrapper">
			<!-- start admin-content -->
			<div class="admin-content container p-0">
				<!-- start responsive  -->
				<Responsive />
				<!-- start left-content -->
				<div class="left-content col-xs-3 col-md-2 p-0">
					<AdminSidebar v-if="role == 'admin'" />
					<AdvertiserSidebar v-if="role == 'advertiser'" />
					<SoldierSidebar v-if="role == 'soldier'" />
				</div>
				<!-- end left-content -->
				<!-- start right-content -->
				<div class="right-content col-xs-9 col-md-10">
					<!-- start header -->
					<DashboardHeader />
					<!-- start Page Title -->
					<PageTitle />
					<!-- start righ-content -->
					<div class="admin-page">
						<nuxt />
					</div>
				</div>
				<!-- end right-content -->
			</div>
			<!-- end admin-content -->
			<div class="clearfix"></div>
			<!-- start copyrights -->
			<Copyrights />
			<!-- end copyrights -->
		</div>
		<!-- end wrapper -->
	</div>
</template>

<script>
	const Components = {
		AdminSidebar: () =>
			import('@/components/dashboard/layouts/sidebars/AdminSidebar.vue'),
		AdvertiserSidebar: () =>
			import('@/components/dashboard/layouts/sidebars/AdvertiserSidebar.vue'),
		SoldierSidebar: () =>
			import('@/components/dashboard/layouts/sidebars/SoldierSidebar.vue'),
		Copyrights: () => import('@/components/dashboard/layouts/Copyrights.vue'),
		Responsive: () => import('@/components/dashboard/layouts/Responsive.vue'),
		DashboardHeader: () =>
			import('@/components/dashboard/layouts/DashboardHeader.vue'),
		PageTitle: () => import('@/components/dashboard/layouts/PageTitle.vue'),
	}

	export default {
		components: Components,

		beforeMount() {
			// this.page = this.page.substring(this.page.lastIndexOf('/')+1)
			// console.log(this.role)
			this.setNotifications()
		},

		updated() {
			this.setNotifications()
		},

		methods: {
			setNotifications() {
				this.$axios
					.$get('notifications')
					.then((res) => {
						this.$store.dispatch('setNotifications', res)
					})
					.catch((err) => {
						error({ statusCode: err.status, message: err.message })
					})
			},
		},
	}
</script>
