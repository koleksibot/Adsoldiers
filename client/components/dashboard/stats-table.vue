<template>
  <client-only>
    <div class="white-box">
      <h2 class="bold">{{title}}</h2>
      <table class="table">
        <tr>
          <th>{{firstCoulmn}}</th>
          <th>Visitors number</th>
        </tr>
        <tr v-for="stat in stats" :key="stat.value">
          <td>{{stat.value}}</td>
          <td class="text-center">{{stat.visitors_number}}</td>
        </tr>
      </table>
    </div>
  </client-only>
</template>

<script>
export default {
  props: ["stats", "title", "firstCoulmn"]
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
