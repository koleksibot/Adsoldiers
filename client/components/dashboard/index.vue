<template>
  <div>
    <!-- Targeted Audience  -->
    <div class="col-lg-7 mb-30">
      <div class="white-box">
        <h2 class="bold">Targeted Audience</h2>
        <table class="table">
          <tr>
            <th>Audience</th>
            <th>Visitors number</th>
          </tr>
          <tr v-for="audience in stats.audience" :key="audience.value">
            <td>{{audience.value}}</td>
            <td class="text-center">{{audience.visitors_number}}</td>
          </tr>
        </table>
      </div>
    </div>
    <!-- clicks -->
    <div class="col-lg-5 mb-30">
      <div class="white-box container">
        <h2 class="bold col-sm-6">Clicks</h2>
        <h2 class="col-sm-6 text-center">{{stats.clicks}}</h2>
      </div>
    </div>
    <!-- gender -->
    <div class="col-lg-5 mb-30">
      <div class="white-box">
        <h2 class="bold">Genders</h2>
        <table class="table">
          <tr>
            <th>Gender</th>
            <th>Visitors number</th>
          </tr>
          <tr v-for="gender in stats.genders" :key="gender.value">
            <td>{{gender.value}}</td>
            <td class="text-center">{{gender.visitors_number}}</td>
          </tr>
        </table>
      </div>
    </div>
    <!-- age -->
    <div class="col-lg-5 mb-30">
      <div class="white-box">
        <h2 class="bold">Ages</h2>
        <table class="table">
          <tr>
            <th>Age</th>
            <th>Visitors number</th>
          </tr>
          <tr v-for="age in stats.ages" :key="age.value">
            <td>{{age.value}}</td>
            <td class="text-center">{{age.visitors_number}}</td>
          </tr>
        </table>
      </div>
    </div>
    <!-- country -->
    <div class="col-lg-5 mb-30">
      <div class="white-box">
        <h2 class="bold">Countries</h2>
        <table class="table">
          <tr>
            <th>Country</th>
            <th>Visitors number</th>
          </tr>
          <tr v-for="country in stats.country" :key="country.value">
            <td>{{country.value}}</td>
            <td class="text-center">{{country.visitors_number}}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      ads: []
    };
  },
  props: ["stats"],
  mounted() {
    // this.a();
  },
  methods: {
    // a() {
    //   console.log(this.user, "s");
    // }
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
</style>