<template>
	<div>
		<div class="row" v-if="totalBalance > 0">
			<div class="col-sm-6 col-md-3">
				<div class="white-box com-box mt-0">
					<h3 class="box-title">{{ totalBalance }}</h3>
					<h5>Total Balance</h5>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="table-responsive com-table">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th width="10%">Title</th>
								<th width="10%">Budget</th>
								<th width="10%">Remaining Budget</th>
								<th width="10%">Status</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="ad in ads" :key="ad.id">
								<td>{{ ad.title }}</td>
								<td>{{ ad.budget }}</td>
								<td>{{ ad.remaining_budget }}</td>
								<td>{{ ad.status }}</td>
							</tr>
						</tbody>
					</table>
				</div>
				<!-- pagination -->
				<!-- <pagination :links="transactions.links" @changePage="fetchData" /> -->
			</div>
		</div>
	</div>
</template>

<script>
	import Pagination from '@/components/dashboard/table/pagination'

	export default {
		layout: 'dashboard',

		middleware: ['auth', 'advertiser'],

		data: () => ({
			totalBalance: 0,
			ads: [],
		}),

		beforeMount() {
			this.getAdsData()
		},

		components: {
			Pagination,
		},

		methods: {
			getAdsData() {
				let requests = [this.$axios.$get('me/balance'), this.$axios.$get('ads')]
				let promises = Promise.all(requests)

				promises
					.then((res) => {
						this.totalBalance = res[0].data.balance
						this.ads = res[1].data.data
					})
					.catch((err) => console.log(err))
			},
			fetchData(value) {
				this.transactions = value
			},
		},
	}
</script>
