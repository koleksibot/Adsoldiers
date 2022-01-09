<template >
  <!-- action buttons -->
  <div class="row text-right">
    <div class="col-sm-12 action-buttons">
      <button class="the-btn2 hvr-radial-out" @click="$router.back()">Cancel</button>
      <button class="the-btn hvr-radial-out" @click="$emit('handleSubmition')">{{actionBtnText}}</button>
    </div>
  </div>
</template>

<script>
export default {
  props: ["actionBtnText"]
};
</script>