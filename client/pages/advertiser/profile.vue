<template>
  <div class="profile">
    <div class="container">
      <div class="row" v-if="!edit">
        <div class="col-md-offset-9 col-md-3">
          <div class="btn the-btn mr-10 pull-right hvr-radial-out" @click="edit = true">Edit Profile</div>
        </div>
      </div>
      <profile v-if="!edit" />
      <edit-profile v-if="edit" />
    </div>
  </div>
</template>

<script>
import Profile from "@/components/profile";
import EditProfile from "@/components/editProfile";

export default {
  data() {
    return {
      edit: false
    };
  },
  components: {
    Profile,
    EditProfile
  }
};
</script>