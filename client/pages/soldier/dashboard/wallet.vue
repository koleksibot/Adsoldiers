<template>
	<div class="row">
		<div class="row">
			<div class="col-sm-12">
				<div class="col-sm-6 col-md-3">
					<div class="white-box com-box">
						<h3 class="box-title">{{ totalBalance }}</h3>
						<h5>Total Balance</h5>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="white-box com-box">
						<h3 class="box-title">{{ transactions.done }}</h3>
						<h5>Done Transactions</h5>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="white-box com-box">
						<h3 class="box-title">{{ transactions.pending }}</h3>
						<h5>Pending Transactions</h5>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="white-box com-box">
						<h3 class="box-title">{{ transactions.canceled }}</h3>
						<h5>Canceled Transactions</h5>
					</div>
				</div>
			</div>
		</div>
		<div class="row no-mar">
			<div class="col-sm-12">
				<!-- transactions history  -->
				<div class="row">
					<div class="col-xs-12 col-md-10">
						<h3>Transactions History ...</h3>
					</div>
				</div>
				<div class="table-responsive com-table">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th width="10%">No.</th>
								<th width="10%">Date</th>
								<th width="10%">Status</th>
								<th width="15%">Amount</th>
								<th width="15%">Balance</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="transaction in transactions.all" :key="transaction.id">
								<td>{{ transaction.transNumber || 'Not Available' }}</td>
								<td>{{ transaction.updated_at || 'Not Available' }}</td>
								<td>
									<span class="label label-danger">{{
										transaction.status
									}}</span>
								</td>
								<td>
									<strong>{{ transaction.amount }}</strong>
								</td>
								<td>
									<strong>{{ transaction.balance }}</strong>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data: () => ({
			totalBalance: 0,
			transactions: {
				all: [],
				done: 0,
				pending: 0,
				canceled: 0,
			},
		}),

		layout: 'dashboard',

		middleware: 'auth',

		mounted() {
			this.getTransactions()
		},

		methods: {
			getTransactions() {
				let requests = [
					this.$axios.$get('me/balance'),
					this.$axios.$get('me/soldier/transactions'),
				]
				let promises = Promise.all(requests)
				promises.then((res) => {
					this.totalBalance = res[0].data.balance
					this.transactions.all = res[1].data.data
					this.transactions.done = this.filterTransactions(res[1], 'done')
					this.transactions.pending = this.filterTransactions(res[1], 'pending')
					this.transactions.canceled = this.filterTransactions(
						res[1],
						'canceled'
					)
				})
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
		},
	}
</script>
