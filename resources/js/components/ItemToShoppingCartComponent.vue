<template>
    <div>
        <a  class="btn btn-fr my-2 w-100"
            v-if="inShoppingCart"
            @click="removeFromShoppingCart()">
            <i class="fas fa-cart-arrow-down mr-1"></i>
            Quitar del carrito
		</a>

        <a  class=" btn w-100 btn-outline-green my-2"
            @click="addToShoppingCart()"
            v-else>
		    <i class="fas fa-shopping-cart mr-1"></i>
		    Agregar al carrito
		</a>
    </div>
</template>

<script>
    export default {

        props: {

            /**
             * Receive an initial selected value.
             */
            item_id: {
                type: String,
                required: true,
                default: ''
            },
            /**
             * Receive an initial selected value.
             */
            url: {
                type: String,
                required: false,
                default: ''
            },
            /**
             * Receive an initial selected value.
             */
            in_cart: {
                type: String,
                required: true,
                default: ''
            },
        },
         data() {
            return {
                inShoppingCart: 0
            };
        },
        methods: {
            removeFromShoppingCart() {  

                axios
                    .get(window.location.origin+'/delete-to-cart/'+this.item_id)
                    .then(response => {

                        let res       = response.data;
                        let isSuccess = res.response === 'success' ? true : false;
                        let alert     = document.querySelector('.alert-'+res.response);
                        let badge     = document.querySelector('.badge-notifications');
                        let count     = parseInt(badge.innerText);
                        let span      = alert.querySelector('span');

                        this.inShoppingCart = isSuccess ? 0 : 1; 
                        badge.innerText     = isSuccess ? count - 1 : count;
                        
                        alert.classList.remove('d-none');
                        span.innerText = res.message;
                    })
                    .catch(error => {
                        console.log(error);
                })
            },
            addToShoppingCart() {   
                                 
                if(!parseInt(this.url)) {
                    window.location.href = window.location.origin+'/login/0';
                }
        
                axios
                    .get(window.location.origin+'/add-to-cart/'+this.item_id)
                    .then(response => {

                        let res       = response.data;
                        let isSuccess = res.response === 'success' ? true : false;
                        let alert     = document.querySelector('.alert-'+res.response);
                        let badge     = document.querySelector('.badge-notifications');
                        let count     = parseInt(badge.innerText);
                        let span      = alert.querySelector('span');

                        this.inShoppingCart = isSuccess ? 1 : 0;
                        badge.innerText     = isSuccess ? count + 1 : count;
                        
                        alert.classList.remove('d-none');
                        span.innerText = res.message;
                    })
                    .catch(error => {
                        console.log(error)
                }) 
            }
        },
        mounted() {             
            this.inShoppingCart = parseInt(this.in_cart);    
        }
    };
</script>
