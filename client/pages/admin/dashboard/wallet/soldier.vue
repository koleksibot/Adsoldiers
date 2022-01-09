<template>
	<div>
		<!-- Success Message -->
		<div :class="`alert ${successMessageClass}`" v-if="successMessage">
			{{ successMessage }}
		</div>
		<div class="table-responsive com-table">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th width="10%">No.</th>
						<th width="10%">Date</th>
						<th width="10%">Soldier</th>
						<th width="10%">Avatar</th>
						<th width="10%">Status</th>
						<th width="15%">Amount</th>
						<th width="15%">Balance</th>
						<th width="15%">Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="transaction in transactions.data" :key="transaction.id">
						<td>{{ transaction.transNumber || 'Not Available' }}</td>
						<td>{{ transaction.updated_at || 'Not Available' }}</td>
						<td>{{ transaction.soldier.username }}</td>
						<td>
							<img
								width="50"
								height="50"
								:src="require(`@/assets/${transaction.soldier.picture}`)"
							/>
						</td>
						<td>
							<span
								class="label"
								:class="{
									'label-info': transaction.status == 'pending',
									'label-success': transaction.status == 'done',
									'label-danger': transaction.status == 'canceled',
								}"
								>{{ transaction.status }}</span
							>
						</td>
						<td>
							<strong>{{ transaction.amount }}</strong>
						</td>
						<td>
							<strong>{{ transaction.balance }}</strong>
						</td>
						<td>
							<button
								title="cancel transaction"
								class="fa fa-times fa-lg btn btn-danger action-btn"
								@click="cancelTrans(transaction)"
								v-if="transaction.status == 'pending'"
							></button>
							<button
								title="done transactions"
								class="fa fa-check fa-lg btn btn-success action-btn"
								@click="transDone(transaction)"
								v-if="transaction.status != 'done'"
							></button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- pagination -->
		<pagination :links="transactions.links" @changePage="fetchData" />
	</div>
</template>

<script>
	import Pagination from '@/components/dashboard/table/pagination'

	export default {
		layout: 'dashboard',

		data: () => ({
			transactions: [],
			successMessage: '',
			successMessageClass: '',
		}),

		watch: {
			successMessage(val) {
				setTimeout(() => {
					this.successMessage = ''
				}, 2500)
			},
		},

		beforeMount() {
			this.getTrans()
		},

		components: {
			Pagination,
		},

		methods: {
			getTrans() {
				this.$axios
					.$get('soldier/transactions')
					.then((res) => {
						this.transactions = res.data
						this.transactions.done = this.filterTransactions(res, 'done')
						this.transactions.pending = this.filterTransactions(res, 'pending')
						this.transactions.canceled = this.filterTransactions(
							res,
							'canceled'
						)
					})
					.catch((err) => console.log(err))
			},
			filterTransactions(response, status) {
				let transactions = response.data.data.filter(
					(transaction) => transaction.status == status
				)
				let transactionsSum = transactions.reduce(
					(total, transaction) => total + transaction.amount,
					0
				)

				return transactionsSum
			},
			transDone(trans) {
				this.$axios
					.$post(`soldier/transactions/${trans.id}/done`, {
						transNumber: trans.transNumber,
					})
					.then((res) => {
						this.successMessage = res.data.message
						if (res.data.transactions) {
							this.transactions = res.data.transactions.data
							this.successMessageClass = 'alert-success'
						}
					})
					.catch((err) => {
						console.log(err)
					})
			},
			cancelTrans(trans) {
				this.$axios
					.$post(`soldier/transactions/${trans.id}/cancel`)
					.then((res) => {
						this.successMessage = res.data.message
						if (res.data.transactions) {
							this.transactions = res.data.transactions.data
							this.successMessageClass = 'alert-danger'
						}
					})
					.catch((err) => {
						console.log(err)
					})
			},
			fetchData(value) {
				this.transactions = value
			},
		},
	}
</script>
