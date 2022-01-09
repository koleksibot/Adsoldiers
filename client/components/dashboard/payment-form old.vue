<template>
  <div class="test">
    <form id="payment_form" @submit.prevent="handleSubmition">
      <input
        type="hidden"
        id="surl"
        name="surl"
        value=" http://127.0.0.1:8000/api/payments/decrypt"
      />
      <div class="dv">
        <span class="text">
          <label>Merchant ID:</label>
        </span>
        <span>
          <input type="text" id="mid" name="mid" placeholder="Merchant ID" value size="50" />
        </span>
      </div>

      <div class="dv">
        <span class="text">
          <label>Merchant Key:</label>
        </span>
        <span>
          <input type="text" id="mkey" name="mkey" placeholder="Merchant Key" value size="50" />
        </span>
      </div>

      <div class="dv">
        <span class="text">
          <label>Collaborator:</label>
        </span>
        <span>
          <input type="text" id="colab" name="colab" placeholder="Collaborator" value="BAYANPAY" />
        </span>
      </div>

      <div class="dv">
        <span class="text">
          <label>Gateway URL:</label>
        </span>
        <span>
          <input
            type="text"
            id="gurl"
            name="gurl"
            placeholder="Gateway URL"
            value="https://staging.bayanpay.sa/direcpay/secure/PaymentTxnServlet"
            size="50"
          />
        </span>
      </div>

      <div class="dv">
        <span class="text">
          <label>Transaction/Order ID:</label>
        </span>
        <span>
          <input type="text" id="txnid" name="txnid" placeholder="Transaction ID" value />
        </span>
      </div>

      <div class="dv">
        <span class="text">
          <label>Amount:</label>
        </span>
        <span>
          <input type="text" id="amount" name="amount" placeholder="Amount" value="6.00" />
        </span>
      </div>

      <div class="dv">
        <span class="text">
          <label>Currency:</label>
        </span>
        <span>
          <input type="text" id="currency" name="currency" placeholder="Currency" value="INR" />
        </span>
      </div>

      <div class="dv">
        <span class="text">
          <label>First Name:</label>
        </span>
        <span>
          <input type="text" id="fname" name="fname" placeholder="First Name" value size="50" />
        </span>
      </div>

      <div class="dv">
        <span class="text">
          <label>Last Name:</label>
        </span>
        <span>
          <input type="text" id="lname" name="lname" placeholder="Last Name" value size="50" />
        </span>
      </div>

      <div class="dv">
        <span class="text">
          <label>Address 1:</label>
        </span>
        <span>
          <input type="text" id="addr1" name="addr1" placeholder="Address 1" value size="50" />
        </span>
      </div>

      <div class="dv">
        <span class="text">
          <label>Address 2:</label>
        </span>
        <span>
          <input type="text" id="addr2" name="addr2" placeholder="Address 2" value size="50" />
        </span>
      </div>

      <div class="dv">
        <span class="text">
          <label>City:</label>
        </span>
        <span>
          <input type="text" id="city" name="city" placeholder="City" value />
        </span>
      </div>

      <div class="dv">
        <span class="text">
          <label>State:</label>
        </span>
        <span>
          <input type="text" id="state" name="state" placeholder="State" value />
        </span>
      </div>

      <div class="dv">
        <span class="text">
          <label>Country (ISO 2):</label>
        </span>
        <span>
          <input type="text" id="country" name="country" placeholder="Country" value="IN" />
        </span>
      </div>

      <div class="dv">
        <span class="text">
          <label>Zip/Post Code:</label>
        </span>
        <span>
          <input type="text" id="postcode" name="postcode" placeholder="Zip/Post Code" value />
        </span>
      </div>

      <div class="dv">
        <span class="text">
          <label>Email ID:</label>
        </span>
        <span>
          <input type="text" id="email" name="email" placeholder="Email ID" value size="50" />
        </span>
      </div>

      <div class="dv">
        <span class="text">
          <label>Mobile/Cell Number:</label>
        </span>
        <span>
          <input type="text" id="mobile" name="mobile" placeholder="Mobile/Cell Number" value />
        </span>
      </div>

      <div id="alertinfo" class="dv"></div>

      <div>
        <input type="submit" id="pay" name="pay" value="Pay" />
      </div>
    </form>
    <button @click.prevent="handleSubmition">press here</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        surl: "http://127.0.0.1:8000/api/payments/decrypt",
        // surl: "http://127.0.0.1:8000/api/a",
        // surl: "http://localhost/byanpay_php7/response.php",
        currency: "SAR",
        fname: "fname",
        lname: "lname",
        addr1: "addr1",
        addr2: "addr2",
        state: "state",
        postcode: "1234",
        city: "city",
        country: "IN",
        email: "email@gmail.com",
        mobile: "01156321668"
      }
    };
  },

  computed: {
    txnid() {
      // return this.$store.getters["localStorage/orderNumber"];
      return "sf654";
    },
    amount() {
      // return this.$store.getters["localStorage/amount"];
      return 222;
    },
    BayanPayForm() {
      return Object.assign(this.form, {
        amount: this.amount,
        txnid: `txnid_${this.txnid}`
      });
    }
  },

  methods: {
    testSubmition() {
      this.$axios.post(
        // "https://payments.bayanpay.sa/direcpay/secure/PaymentTxnServlet",
        "http://www.vi.hit/test",
        this.form
      );
    },
    handleSubmition() {
      let processedData = this.$axios
        .$post("payments/encrypt", this.BayanPayForm)
        .then(res => {
          // return console.log(res.data.merchant_id);

          let fr =
            '<form action="' +
            res.data.action +
            '" method="post">' +
            '<input type="hidden" name="MerchantID" value="' +
            res.data.merchant_id +
            '" />' +
            '<input type="hidden" name="CollaboratorID" value="' +
            res.data.collaborator_id +
            '" />' +
            '<input type="hidden" name="requestParameter" value="' +
            res.data.merchant_id +
            "||" +
            res.data.collaborator_id +
            "||" +
            res.data.request_parameter +
            '" />' +
            "</form>";

          // console.log(fr);
          let form = jQuery(fr);
          $(".test").append(form);
          form.submit();
        });

      // var fr =
      //   '<form action="' +
      //   this.action +
      //   '" method="post">' +
      //   '<input type="hidden" name="MerchantID" value="' +
      //   this.MerchantID +
      //   '" />' +
      //   '<input type="hidden" name="CollaboratorID" value="' +
      //   this.CollaboratorID +
      //   '" />' +
      //   '<input type="hidden" name="requestParameter" value="' +
      //   this.MerchantID +
      //   "||" +
      //   this.CollaboratorID +
      //   "||" +
      //   requestParameter +
      //   '" />' +
      //   "</form>";

      // // console.log(fr);
      // var form = jQuery(fr);
      // $(".test").append(form);
      // form.submit();
    }
  }
};
</script>
