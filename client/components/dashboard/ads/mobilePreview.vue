<template>
	<div>
		<!-- Uploading File -->
		<div class="row upload-file">
			<!-- media type  -->
			<div class="col-sm-12 col-md-6">
				<div class="form-group dash-group">
					<label>Media Type *</label>
					<multiselect
						v-model="form.selectedMedia_type"
						:options="media_type"
						:preserve-search="true"
						placeholder="Pick A Media Type"
						label="name"
						track-by="name"
						:class="{ 'is-invalid': errors.media_type }"
					></multiselect>
					<p class="text-danger p-2" v-for="error in errors.media_type">
						{{ error }}
					</p>
				</div>
			</div>
			<!-- uploade file  -->
			<div
				class="col-sm-12 col-md-offset-6 col-md-6 p-4"
				v-if="form.selectedMedia_type !== ''"
			>
				<div class="form-group dash-group">
					<label>Upload Your File</label>
					<div class="row">
						<div class="col-xs-6">
							<input class="media" type="file" multiple />
						</div>
						<p
							class="col-xs-6 mt-10 hint"
							v-if="['slider', 'image'].includes(form.selectedMedia_type)"
						>
							Image Ideal Dimension is more than 200 x 200 with
							extensions(jpg,jpeg,png)
						</p>
						<p
							class="col-xs-6 mt-10 hint"
							v-if="form.selectedMedia_type == 'video'"
						>
							Video size mustn't exceed 5 MB with extensions(MP4)
						</p>
					</div>
				</div>
			</div>
		</div>
		<!-- preview  -->
		<div class="row mobile-preview">
			<div class="col-sm-12 mb-10">
				<h3>Preview</h3>
			</div>
			<!-- mobile -->
			<div class="col-sm-3">
				<h4>Mobile Preview</h4>
				<div class="mobile-frame1">
					<div class="mobile-frame2">
						<img :src="form.mediaPreview" alt />
						<video :src="form.mediaPreview" autoplay="autoplay"></video>
					</div>
					<div class="dot"></div>
				</div>
			</div>
			<!-- desktop -->
			<div class="col-sm-3">
				<h4>Desktop Preview</h4>
				<div class="desktop-frame1">
					<div class="desktop-frame2">
						<img :src="form.mediaPreview" alt />
						<video :src="form.mediaPreview" autoplay="autoplay"></video>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: {
			initialMediaType: {
				type: String,
				default: '',
			},
			initialMediaPreview: {
				type: String,
				default: '',
			},
		},

		data() {
			return {
				media_type: [
					{ name: 'Image', value: 'image' },
					{ name: 'Slider', value: 'slider' },
					{ name: 'Video', value: 'video' },
				],
				form: {
					selectedMedia_type: '',
					mediaPreview: [],
					media: {},
				},
			}
		},

		updated() {
			$('.media').on('change', (event) => {
				this.previewMedia(event)
				this.form.media = [...event.target.files]
				this.$emit('fileUploaded', this.form)
			})
		},

		mounted() {
			if (this.initialMediaType) {
				this.form.selectedMedia_type = this.initialFormDropdown(
					this.initialMediaType,
					this.media_type
				)
			}
			if (this.initialMediaPreview) {
				this.form.mediaPreview = require(`@/assets/img/${this.initialMediaPreview}`)
			}
		},

		methods: {
			initialFormDropdown(needles, haystack) {
				return haystack.find(({ value }) => needles.includes(value))
			},
			previewMedia(event) {
				let reader = new FileReader()
				let file = event.target.files[0]

				reader.readAsDataURL(file)

				reader.onloadend = (e) => {
					this.form.mediaPreview = reader.result
				}
			},
		},
	}
</script>
