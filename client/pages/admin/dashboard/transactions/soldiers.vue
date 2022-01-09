<template>
	<div>
		<!-- Success Message -->
		<div :class="`alert ${successMessage_bg}`" v-if="successMessage">
			{{ successMessage }}
		</div>
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th width="50%">Name</th>
						<th width="10%">Avatar</th>
						<th width="20%">Price</th>
						<th width="20%">Status</th>
						<th width="20%">Transfer Money</th>
						<th width="20%">Decline transaction</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="transaction in transactions.data" :key="transaction.id">
						<td>{{ transaction.soldier.username }}</td>
						<td>
							<img
								width="50"
								height="50"
								:src="require(`@/assets/${transaction.soldier.picture}`)"
							/>
						</td>
						<td>{{ transaction.amount }}</td>
						<td>{{ transaction.status }}</td>
						<td>
							<button
								class="the-btn hvr-radial-out"
								@click="doneTransaction(transaction.id)"
							>
								Transfer
							</button>
						</td>
						<td>
							<button
								class="the-btn hvr-radial-out decline"
								@click="cancelTransaction(transaction.id)"
							>
								Decline
							</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				transactions: '',
				successMessage: '',
			}
		},

		layout: 'dashboard',

		middleware: ['auth', 'admin'],
		async asyncData({ $axios }) {
			let response = await $axios.$get('soldier/transactions')
			return {
				transactions: response.data,
			}
		},

		methods: {
			doneTransaction(transactionId) {
				this.$axios
					.$post(`soldier/transactions/${transactionId}/done`)
					.then((res) => {
						this.successMessage = res.data.message
						this.successMessage_bg = 'alert-success'
						this.transactions = res.data.transactions
					})
					.catch((err) => {
						this.successMessage = err.data.message
						this.successMessage_bg = 'alert-danger'
					})
			},
			cancelTransaction(transactionId) {
				this.$axios
					.$post(`soldier/transactions/${transactionId}/cancel`)
					.then((res) => {
						this.successMessage = res.data.message
						this.successMessage_bg = 'alert-success'
						this.transactions = res.data.transactions
					})
					.catch((err) => {
						this.successMessage = err.data.message
						this.successMessage_bg = 'alert-danger'
					})
			},
		},
	}
</script>
