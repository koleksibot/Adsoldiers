<template>
  <client-only>
    <apexchart type="pie" width="380" :options="chartOptions" :series="series"></apexchart>
  </client-only>
</template>

<script>
export default {
  data() {
    return {
      series: [],
      chartOptions: {
        chart: {
          width: 380,
          type: "pie"
        },
        labels: [],
        responsive: [
          {
            breakpoint: 480,
            options: {
              chart: {
                width: 200
              },
              legend: {
                position: "bottom"
              }
            }
          }
        ]
      }
    };
  },
  props: ["statistics"],
  mounted() {
    this.setLabels();
    this.setSeries();
  },
  methods: {
    setLabels() {
      let $labels = [];
      this.statistics.forEach(statistic => $labels.push(statistic.value));
      this.chartOptions.labels = $labels;
    },
    setSeries() {
      let series = [];
      let totalVisitors = this.totalVisitors();

      this.statistics.forEach(statistic => {
        let visitorsPercentage =
          parseInt(statistic.visitors_number) / totalVisitors;

        series.push(visitorsPercentage);
      });

      this.series = series;
    },
    totalVisitors() {
      let totalVisitors = 0;
      this.statistics.map(statistic => {
        totalVisitors += parseInt(statistic.visitors_number);
      });

      return totalVisitors;
    }
  }
};
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
.bar-chart {
  position: fixed;
  left: 10%;
  top: 10%;
  width: 80%;
  height: 80%;
}
</style>
