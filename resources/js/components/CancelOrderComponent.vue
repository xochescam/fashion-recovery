
											
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
    order: {
      type: String,
      required: false,
      default: ''
    },
  },
  methods: {
    cancel() {

        window.axios
            .get(this.$root.path+"/cancel-order/"+this.order)
            .then(response => {

              window.location.href = this.$root.path + '/orders';
            
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