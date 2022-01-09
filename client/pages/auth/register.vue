<template>
  <div class="internal-page">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="title title2">
            <h2>signup</h2>
            <p>Enter Your Data to Continue</p>
          </div>
        </div>
        <div class="col-sm-12">
          <!-- start tabs -->
          <ul class="nav nav-pills">
            <li :class="{ active: formType == 'advertiser' }">
              <a
                data-toggle="pill"
                @click.prevent="changeForm('advertiser')"
                href="#"
                >Sign Up as Company</a
              >
            </li>
            <li :class="{ active: formType == 'soldier' }">
              <a
                data-toggle="pill"
                href="#"
                @click.prevent="changeForm('soldier')"
                >Sign Up as User</a
              >
            </li>
          </ul>
          <!-- end tabs -->
          <!-- start form  -->
          <div class="tab-content">
            <div id="signup-company" class="tab-pane fade in active">
              <div class="layout1">
                <form>
                  <div class="form-group" v-if="formType == 'advertiser'">
                    <input
                      type="text"
                      class="form-control the-input"
                      placeholder="Enter Company Name"
                      v-model="form.company"
                      :class="{ 'is-invalid': errors.company }"
                    />
                  </div>
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control the-input"
                      placeholder="Enter Email Address"
                      v-model="form.email"
                      :class="{ 'is-invalid': errors.email }"
                    />
                    <p class="text-danger p-2" v-for="error in errors.email">
                      {{ error }}
                    </p>
                  </div>
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control the-input"
                      placeholder="Enter Username"
                      v-model="form.username"
                      :class="{ 'is-invalid': errors.username }"
                    />
                    <p class="text-danger p-2" v-for="error in errors.username">
                      {{ error }}
                    </p>
                  </div>
                  <div class="form-group">
                    <input
                      type="Password"
                      class="form-control the-input"
                      placeholder="Enter Password"
                      v-model="form.password"
                      :class="{ 'is-invalid': errors.password }"
                    />
                    <p class="text-danger p-2" v-for="error in errors.password">
                      {{ error }}
                    </p>
                  </div>
                  <div class="form-group">
                    <input
                      type="Password"
                      class="form-control the-input"
                      placeholder="Confirm Password"
                      v-model="form.password_confirmation"
                    />
                    <p
                      class="text-danger p-2"
                      v-for="error in errors.password_confirmation"
                    >
                      {{ error }}
                    </p>
                  </div>
                  <div class="form-group">
                    <button
                      type="submit"
                      class="btn the-btn btn-block hvr-radial-out"
                      @click.prevent="signup"
                    >
                      Register
                    </button>
                  </div>
                  <div class="form-group text-center">
                    <p class="color2">
                      Already have an account ?
                      <nuxt-link :to="{ name: 'auth-login' }" class="color1"
                        >Login</nuxt-link
                      >
                    </p>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- end form -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  data() {
    return {
      message: "",
      formType: "advertiser",
      form: {
        company: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
    };
  },
  methods: {
    changeForm(type) {
      this.formType = type;
      this.form.company = "";
      this.form.username = "";
      this.form.email = "";
      this.form.password = "";
      this.form.password_confirmation = "";
    },
    signup() {
      this.form.company == "" ? delete this.form.company : "";
      this.$axios
        .post("auth/register", this.form)
        .then((res) => {
          if (res.status == 201) {
            setTimeout(() => {
              this.$router.push("/auth/login");
            }, 1000);
          }
        })
        .catch((error) => {
          if (error.response.status == 401) {
            $nuxt.error({
              message: error.response.data.errors,
            });
          }
        });
    },
  },
};
</script>