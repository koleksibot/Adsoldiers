<template>
	<campaign-index :initialCampaigns="campaigns" />
</template>

<script>
	import CampaignIndex from '@/components/dashboard/campaigns/index'

	export default {
		data() {
			return {
				campaigns: [],
			}
		},
		components: {
			CampaignIndex,
		},
		layout: 'dashboard',
		middleware: ['auth', 'admin'],
		async asyncData({ app }) {
			let response = await app.$axios.$get('campaigns')
			return {
				campaigns: response.data,
			}
		},
	}
</script>
