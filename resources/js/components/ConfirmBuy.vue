<template>
  <div>
    <button class="btn btn-fr d-flex justify-content-center" 
      :disabled="isClicked"
      @click="confirm()">
      <span :class="'spinner-border spinner-border-sm '+( !this.isClicked ? 'hidden' : '' )"
       role="status" aria-hidden="true"></span>
      Pagar
    </button>
  </div>
</template>

<script>
export default {
  props: {

    /**
    * Receive an initial selected value.
    */
    shipping: {
      type: String,
      required: false,
      default: ''
    },
  },
  data() {
    return {
      isClicked: false
    };
  },
  methods: {
    confirm() {

      $(".js-loader-payment").modal({
        backdrop: "static",
        keyboard: false,
        show: true
      });

      this.isClicked = true;
      window.axios
        .get(window.location.origin+'/confirmation/'+this.shipping)
        .then(response => {

          window.location.href = window.location.origin+'/summary/'+this.shipping;

          //$(".js-loader-payment").modal("hide");
        
        })
        .catch(error => {
          console.log(error)
        })
    }
  }
};
</script>