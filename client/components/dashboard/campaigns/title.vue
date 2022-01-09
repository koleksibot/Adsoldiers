<template>
    <div>
        <div class="row">
            <h1 class="pl-4 bold ">{{campaign.title}}</h1>
            <div class="col-sm-12 mb-30">
                <h4>Description</h4>
                <p>{{campaign.description}}</p>
            </div>
            <div class="col-sm-12">
                <div class="white-box">
                    <h3>Content</h3>
                    <p class="lead">{{campaign.content}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-6 col-md-3">
                    <div class="white-box com-box">
                        <h3 class="box-title">{{campaign.industry}}</h3>
                        <h5>Industry</h5>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="white-box com-box">
                        <h3 class="box-title">{{campaign.location}}</h3>
                        <h5>Location</h5>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="white-box com-box">
                        <h3 class="box-title">{{campaign.type}}</h3>
                        <h5>Type</h5>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="white-box com-box">
                        <h3 class="box-title">{{campaign.budget}}</h3>
                        <h5>Budget</h5>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="white-box com-box">
                        <h3 class="box-title">{{campaign.remaining_budget}}</h3>
                        <h5>Remaining Budget</h5>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="white-box com-box">
                        <h3 class="box-title">{{campaign.start_date}}</h3>
                        <h5>Start Date</h5>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="white-box com-box">
                        <h3 class="box-title">{{campaign.end_date}}</h3>
                        <h5>End Date</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'campaign'
        ],
        // created() {
        //   this.test();
        // },
        // methods: {
        //     test() {
        //         delete this.campaign.id;
        //         console.log(this.campaign)
        //     }
        // }
    }
</script>