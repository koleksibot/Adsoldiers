<template>
	<div>
		<!-- gender block -->
		<div class="genders-block row mb-20" v-if="stats.genders.length != 0">
			<stats-chart class="col-lg-7" :statistics="stats.genders" />
			<div class="col-lg-5 mb-30">
				<stats-table
					title="Genders"
					firstCoulmn="Gender"
					:stats="stats.genders"
				/>
			</div>
		</div>
		<!-- age block-->
		<div class="ages-block row mb-20" v-if="stats.ages.length != 0">
			<stats-chart class="col-lg-7" :statistics="stats.ages" />
			<div class="col-lg-5 mb-30">
				<stats-table title="Ages" firstCoulmn="Age" :stats="stats.ages" />
			</div>
		</div>
		<!-- Targeted Audience  -->
		<div class="col-lg-7 mb-30" v-if="stats.audience.length != 0">
			<stats-table
				title="Targeted Audience"
				firstCoulmn="Audience"
				:stats="stats.audience"
			/>
		</div>
		<!-- clicks -->
		<div class="col-lg-5 mb-30" v-if="stats">
			<div class="white-box container">
				<div class="row" v-if="stats.clicks">
					<h2 class="bold col-sm-9">Total Clicks</h2>
					<h2 class="col-sm-3 text-center">{{ stats.clicks }}</h2>
				</div>
				<div class="row" v-if="stats.monthly_clicks">
					<h2 class="bold col-sm-9">Clicks For This Month</h2>
					<h2 class="col-sm-3 text-center">{{ stats.monthly_clicks }}</h2>
				</div>
			</div>
		</div>
		<!-- country -->
		<div class="col-lg-5 mb-30" v-if="stats.country.length != 0">
			<stats-table
				title="Countries"
				firstCoulmn="Country"
				:stats="stats.country"
			/>
		</div>
	</div>
</template>

<script>
	import StatsTable from './dashboard/stats-table'
	import StatsChart from './dashboard/stats-chart'

	export default {
		props: ['stats'],
		components: {
			StatsTable,
			StatsChart,
		},
	}
</script>

<style lang="scss">
	.table {
		tr {
			line-height: 2.5;
			border-bottom: 1px solid #000;
			&:first-child {
				line-height: 4;
			}
		}
	}
</style>
