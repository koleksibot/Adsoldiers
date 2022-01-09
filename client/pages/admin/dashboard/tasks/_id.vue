<template>
  <div class="row-2">
    <div class="fixed alert alert-danger" v-if="successMessage">{{successMessage}}</div>
    <div class="col-sm-12">
      <div class="form-group dash-group">
        <label>Title *</label>
        <input class="form-control dash-input" placeholder="Example Task" type="text" v-model="form.title" :class="{ 'is-invalid' : errors.title}">
           <p class="text-danger p-2" v-for="error in errors.title">{{error}}</p>
      </div>
    </div>
    <div class="col-sm-12">
      <div class="form-group dash-group">
          <label>Description</label>
          <input class="form-control dash-input" placeholder="Please Enter The Description" v-model="form.description" :class="{ 'is-invalid' : errors.description}"></input>
          <p class="text-danger p-2" v-for="error in errors.description">{{error}}</p>
      </div>
    </div>
    <div class="col-sm-12">
      <div class="form-group dash-group">
          <label>Content</label>
          <textarea class="form-control dash-input" placeholder="Please Enter The Content" v-model="form.content" :class="{ 'is-invalid' : errors.content}"></textarea>
          <p class="text-danger p-2" v-for="error in errors.content">{{error}}</p>
      </div>
    </div>
    <div class="col-sm-12">
      <div class="form-group dash-group">
        <label>Upload Photo or Video</label>
        <input type="file" @change.prevent="handleFileUpload" multiple>
      </div>
    </div>
    <div class="col-sm-12 text-right">
      <button class="the-btn2 hvr-radial-out" @click="$router.back()">Cancel</button>
      <button class="the-btn hvr-radial-out" @click="handleSubmition">Create Task</button>
    </div>
  </div>
</template>

<script>
    export default {
      data() {
          return {
            successMessage: '',
            form:{
              media: [],
            }
          }
        },
        layout: 'dashboard',
        async asyncData({app, params}) {
          let task = await app.$axios.$get(`tasks/${params.id}`);
          return {
            form: {
                title: task.data.title,
                description: task.data.description,
                content: task.data.content,
           }};
        },
        methods: {
            handleSubmition () {
                // Initialize the form data
                let formData = new FormData();
                formData.append('media[]', this.form.media)
                formData.append('description', this.form.description)
                formData.append('content', this.form.content)
                formData.append('title', this.form.title)

                this.$axios.$post(`tasks/${this.$route.params.id}`,
                                   formData, 
                                   {
                                        header: {
                                            'Content-Type': 'multipart/form-data'
                                        }
                                   }
                                )
                            .then( res => {
                                    this.successMessage = res.data.message;
                                    setTimeout(() => {this.$router.push('../tasks')}, 1500)
                            })
                            .catch(err => {
                                console.log(err)
                            })
            },
            handleFileUpload() {
              this.form.media = event.target.files[0];
            }
        },
          middleware: [
            'auth',
            'admin'
        ]
    }
</script>