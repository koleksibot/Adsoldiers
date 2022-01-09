<template>
	<div>
		<div class="row">
			<div class="fixed alert alert-danger" v-if="successMessage">
				{{ successMessage }}
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="form-group dash-group">
					<label>Campaign *</label>
					<multiselect
						v-model="initialForm.campaign"
						:options="campaigns"
						:custom-label="campaignCustomLabel"
						placeholder="Pick A Media Type"
						track-by="id"
						deselect-label="Can't remove this value"
						:allow-empty="false"
						:class="{ 'is-invalid': errors.campaign_id }"
						@input="singleSetToFormData('campaign_id', $event.id)"
					></multiselect>
					<p class="text-danger p-2" v-for="error in errors.campaign_id">
						{{ error }}
					</p>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="form-group dash-group">
					<label>Title *</label>
					<input
						class="form-control dash-input"
						placeholder="Example Ad"
						type="text"
						v-model="initialForm.title"
						:class="{ 'is-invalid': errors.title }"
						@input="singleSetToFormData('title', initialForm.title)"
					/>
					<p class="text-danger p-2" v-for="error in errors.title">
						{{ error }}
					</p>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="form-group dash-group">
					<label>Broadcast Content *</label>
					<!-- Descrition text area -->
					<textarea
						class="form-control dash-input"
						placeholder="Please Enter Ad's Content"
						type="text"
						v-model="initialForm.content"
						:class="{ 'is-invalid': errors.content }"
						@input="singleSetToFormData('content', initialForm.content)"
					></textarea>
					<p class="text-danger p-2" v-for="error in errors.content">
						{{ error }}
					</p>
					<!-- emotions -->
					<div class="emotions">
						<client-only>
							<emoji-picker @emoji="insert" :search="search">
								<div
									class="emoji-invoker"
									slot="emoji-invoker"
									slot-scope="{ events: { click: clickEvent } }"
									@click.stop="clickEvent"
								>
									<svg
										height="24"
										viewBox="0 0 24 24"
										width="24"
										xmlns="http://www.w3.org/2000/svg"
									>
										<path d="M0 0h24v24H0z" fill="none" />
										<path
											d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"
										/>
									</svg>
								</div>
								<div
									slot="emoji-picker"
									slot-scope="{ emojis, insert, display }"
								>
									<div class="emoji-picker">
										<div class="emoji-picker__search">
											<input type="text" v-model="search" v-focus />
										</div>
										<div>
											<div
												v-for="(emojiGroup, category) in emojis"
												:key="category"
											>
												<h5>{{ category }}</h5>
												<div class="emojis">
													<span
														v-for="(emoji, emojiName) in emojiGroup"
														:key="emojiName"
														@click="insert(emoji)"
														:title="emojiName"
														>{{ emoji }}</span
													>
												</div>
											</div>
										</div>
									</div>
								</div>
							</emoji-picker>
						</client-only>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="form-group dash-group">
					<label>Gender *</label>
					<multiselect
						v-model="initialForm.gender"
						:options="gender"
						:preserve-search="true"
						placeholder="Pick A gender"
						label="name"
						track-by="name"
						:class="{ 'is-invalid': errors.gender }"
						@input="singleSetToFormData('gender', $event.value)"
					></multiselect>
					<p class="text-danger p-2" v-for="error in errors.gender">
						{{ error }}
					</p>
				</div>
			</div>
			<!-- Demographics -->
			<div class="col-sm-12 mb-10">
				<h3>Demographics</h3>
				<p>
					Hold down the Ctrl (windows) / Command (Mac) button to select multiple
					options.
				</p>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="form-group dash-group">
					<label>Age *</label>
					<multiselect
						v-model="form.age"
						:options="analytics.age"
						:multiple="true"
						:close-on-select="false"
						:clear-on-select="false"
						:preserve-search="true"
						placeholder="Pick An Age"
						label="value"
						track-by="value"
						:class="{ 'is-invalid': errors.age }"
						@input="handleMultiDropdown('age', form['age'])"
					>
						<template slot="selection" slot-scope="{ values, search, isOpen }">
							<span
								class="multiselect__single"
								v-if="values.length &amp;&amp; !isOpen"
								>{{ values.length }} options selected</span
							>
						</template>
					</multiselect>
					<p class="text-danger p-2" v-for="error in errors.age">{{ error }}</p>
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="form-group dash-group">
					<label>Targeted Audience *</label>
					<multiselect
						v-model="form.targeted_audience"
						:options="analytics.interest"
						:multiple="true"
						:close-on-select="false"
						:clear-on-select="false"
						:preserve-search="true"
						placeholder="Pick A Targeted Audience"
						label="value"
						track-by="value"
						:class="{ 'is-invalid': errors.targeted_audience }"
						@input="
							handleMultiDropdown(
								'targeted_audience',
								form['targeted_audience']
							)
						"
					>
						<template slot="selection" slot-scope="{ values, search, isOpen }">
							<span
								class="multiselect__single"
								v-if="values.length &amp;&amp; !isOpen"
								>{{ values.length }} options selected</span
							>
						</template>
					</multiselect>
					<p class="text-danger p-2" v-for="error in errors.targeted_audience">
						{{ error }}
					</p>
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="form-group dash-group">
					<label>Country *</label>
					<multiselect
						v-model="form.country"
						:options="countries"
						:multiple="true"
						:close-on-select="false"
						:clear-on-select="false"
						:preserve-search="true"
						placeholder="Pick A Country"
						label="value"
						track-by="id"
						:class="{ 'is-invalid': errors.country }"
						@input="
							handleMultiDropdown('country', form['country'])
							fetchCities()
						"
					>
						<template slot="selection" slot-scope="{ values, search, isOpen }">
							<span
								class="multiselect__single"
								v-if="values.length &amp;&amp; !isOpen"
								>{{ values.length }} options selected</span
							>
						</template>
					</multiselect>
					<p class="text-danger p-2" v-for="error in errors.country">
						{{ error }}
					</p>
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="form-group dash-group">
					<label>City *</label>
					<multiselect
						v-model="form.city"
						:options="cities"
						:multiple="true"
						:close-on-select="false"
						:clear-on-select="false"
						:preserve-search="true"
						placeholder="Pick A City"
						label="value"
						track-by="id"
						:class="{ 'is-invalid': errors.city }"
						@input="handleMultiDropdown('city', form['city'])"
					>
						<template slot="selection" slot-scope="{ values, search, isOpen }">
							<span
								class="multiselect__single"
								v-if="values.length &amp;&amp; !isOpen"
								>{{ values.length }} options selected</span
							>
						</template>
					</multiselect>
					<p class="text-danger p-2" v-for="error in errors.city">
						{{ error }}
					</p>
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="form-group dash-group">
					<label>Language *</label>
					<multiselect
						v-model="form.language"
						:options="languages"
						:multiple="true"
						:close-on-select="false"
						:clear-on-select="false"
						:preserve-search="true"
						placeholder="Pick A Language"
						label="value"
						track-by="id"
						:class="{ 'is-invalid': errors.language }"
						@input="handleMultiDropdown('language', form['language'])"
					>
						<template slot="selection" slot-scope="{ values, search, isOpen }">
							<span
								class="multiselect__single"
								v-if="values.length &amp;&amp; !isOpen"
								>{{ values.length }} options selected</span
							>
						</template>
					</multiselect>
					<p class="text-danger p-2" v-for="error in errors.language">
						{{ error }}
					</p>
				</div>
			</div>
		</div>
		<div class="row mt-20">
			<div class="col-sm-6">
				<div class="form-group dash-group">
					<label>Call Of Action</label>
					<label class="col-sm-12 p-0">Text *</label>
					<input
						class="form-control dash-input"
						placeholder="Please Enter The Link"
						type="text"
						v-model="initialForm.call_of_action_txt"
						:class="{ 'is-invalid': errors.call_of_action }"
						@input="
							singleSetToFormData(
								'call_of_action_txt',
								initialForm.call_of_action_txt
							)
						"
					/>
					<p class="text-danger p-2" v-for="error in errors.call_of_action">
						{{ error }}
					</p>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group dash-group">
					<label class="col-sm-12 p-0 mt-40">Link*</label>
					<input
						class="form-control dash-input"
						placeholder="Please Enter The Link"
						type="text"
						v-model="initialForm.call_of_action_url"
						:class="{ 'is-invalid': errors.call_of_action }"
						@input="
							singleSetToFormData(
								'call_of_action_url',
								initialForm.call_of_action_url
							)
						"
					/>
					<p class="text-danger p-2" v-for="error in errors.call_of_action">
						{{ error }}
					</p>
				</div>
			</div>
			<!-- mobile preview -->
			<mobile-preview
				@fileUploaded="handleFileUpload"
				:initialMediaType="initialForm.media_type.value"
				:initialMediaPreview="initialForm.media[0]"
			/>
			<!-- action buttons -->
			<action-buttons
				actionBtnText="Update Ad"
				v-on:handleSubmition="handleSubmition"
			/>
		</div>
	</div>
</template>

<script>
	const components = {
		MobilePreview: () => import('@/components/dashboard/ads/mobilePreview.vue'),
		ActionButtons: () => import('@/components/dashboard/action-buttons.vue'),
	}

	export default {
		layout: 'dashboard',
		middleware: ['advertiser', 'auth'],
		data() {
			return {
				initialCampaign: [],
				successMessage: '',
				value: [],
				input: '',
				search: '',
				cities: [],
				gender: [
					{ name: 'Male', value: 'male' },
					{ name: 'Female', value: 'female' },
					{ name: 'Both', value: 'both' },
				],
				media_type: [
					{ name: 'Image', value: 'image' },
					{ name: 'Slider', value: 'slider' },
					{ name: 'Video', value: 'video' },
				],
				campaigns: '',
				ad: '',
				analytics: '',
				placeholder: '',
				shortcuts: [],
				date: '',
				format: 'Y-m-d',
				form: {
					age: [],
					targeted_audience: [],
					language: [],
					city: [],
				},
				initialForm: {},
			}
		},
		components,
		watch: {
			date: function() {
				this.form.start_date = this.formatingDate(this.date[0])
				this.form.end_date = this.formatingDate(this.date[1])
			},
			'initialForm.media': function(val) {
				this.form.media = val
			},
		},
		mounted() {
			this.intialDate()
			this.formData = new FormData()
			this.dropdownInitialSetters()
		},
		methods: {
			insert(emoji) {
				this.form.content += emoji
			},
			initialFormDropdown(needles, haystack) {
				return haystack.filter(({ value }) => needles.includes(value))
			},
			fetchCities() {
				let selectedCountries = []
				selectedCountries = this.form.country.map((country) => country.id)
				// join the countries ids to form string to send in the url of request
				selectedCountries = selectedCountries.join()
				// axios get request and the fetched data stord in cities property
				this.$axios
					.$get('ads/cities/' + selectedCountries)
					.then((res) => {
						this.cities = res.data
						this.setInitialCity()
					})
					.catch((err) => {
						console.log(err)
					})
			},
			dropdownInitialSetters() {
				this.initialForm.gender = this.gender.find(
					({ value }) => value === this.initialForm.gender
				)
				this.initialForm.media_type = this.media_type.find(
					({ value }) => value == this.initialForm.media_type
				)
				this.form.language = this.initialFormDropdown(
					this.initialForm.language,
					this.languages
				)
				this.form.country = this.initialFormDropdown(
					this.initialForm.country,
					this.countries
				)
				this.fetchCities()
				this.form.age = this.initialFormDropdown(
					this.initialForm.age,
					this.analytics.age
				)
				this.form.targeted_audience = this.initialFormDropdown(
					this.initialForm.targeted_audience,
					this.analytics.interest
				)
			},
			setInitialCity() {
				this.form.city = this.initialFormDropdown(
					this.initialForm.city,
					this.cities
				)
			},
			singleSetToFormData(key, value) {
				this.formData.append(key, value)
			},
			handleMultiDropdown(key, selected) {
				selected = selected.map((obj) => obj.value)
				this.formData.append(key, selected)
			},
			campaignCustomLabel({ title, type }) {
				return `${title} — [${type}]`
			},
			handleSubmition() {
				let form = this.form || ''
				//   // itterate through keys of form array to append them to formData
				this.$axios
					.$post(`ads/${this.$route.params.id}`, this.formData, {
						header: {
							'Content-Type': 'multipart/form-data',
						},
					})
					.then((res) => {
						this.successMessage = res.data.message
						setTimeout(() => {
							this.$router.push({ name: 'admin-dashboard-ads' })
						}, 1000)
					})
					.catch((err) => {
						console.log(err)
					})
			},
			handleFileUpload(value) {
				this.singleSetToFormData('media_type', value.selectedMedia_type.value)
				Object.keys(value.media).map((key) => {
					return this.formData.append('media[]', value.media[key])
				})
			},
			formatingDate(date) {
				let result =
					date.getFullYear() +
					'-' +
					(date.getMonth() + 1) +
					'-' +
					date.getDate()

				return String(result)
			},
			intialDate() {
				this.placeholder =
					this.initialForm.start_date + ' ~ ' + this.initialForm.end_date
			},
		},
		async asyncData({ app, params }) {
			let request = [
				app.$axios.$get(`ads/${params.id}`),
				app.$axios.$get('campaigns'),
				app.$axios.$get('analytics'),
				app.$axios.$get('ads/countries'),
				app.$axios.$get('ads/language'),
			]

			let response = await Promise.all(request)

			return {
				initialForm: response[0].data,
				campaigns: response[1].data.data,
				analytics: response[2].data,
				countries: response[3].data,
				languages: response[4].data,
			}
		},
	}
</script>
