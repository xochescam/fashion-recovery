
											
<template>
  <div>
    <a class="text-danger cursor-pointer" @click="cancel">Cancelar pedido</a>
  </div>
</template>

<script>
export default {
  props: {

    /**
    * Receive an initial selected value.
    */
    guide: {
      type: String,
      required: false,
      default: ''
    },
  },
  methods: {
    cancel() {

        window.axios
            .get(window.location.origin+"/cancel-order/"+this.guide)
            .then(response => {

                console.log(response)
            
            })
            .catch(error => {
            console.log(error)
            })
    }
  },
  mounted() {
    console.log('cancel order');
  }
};
</script>