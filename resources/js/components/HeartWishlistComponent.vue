<template>
    <div>
        <a v-if="type === 'card' && hasWish" @click="removeFromWishlist()">
            <i class="fas fa-heart heart-wishlist heart-wishlist--active"></i>
        </a>

        <a @click="addToWishlist()" 
            v-else-if="type === 'card'">
            <i class="far fa-heart heart-wishlist"></i>
        </a>

        <a class="btn w-100 btn-outline-green my-2 my-sm-0"
            @click="removeFromWishlist()"
            v-if="type === 'full' && hasWish">
			<i class="fas fa-heart mr-1"></i>
			Agregado a mis favoritos
		</a>

        <a class="btn w-100 btn-outline-green my-2 my-sm-0"
            @click="addToWishlist()" 
            v-else-if="type === 'full'">
			<i class="far fa-heart mr-1"></i>
			Agregar a mis favoritos
		</a>
    </div>
</template>

<script>
    export default {

        props: {

            /**
             * Receive an initial selected value.
             */
            has: {
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
            type: {
                type: String,
                required: true,
                default: ''
            },
        },
         data() {
            return {
                hasWish: []
            };
        },
        methods: {
            removeFromWishlist() {    

                axios
                    .get(window.location.origin+'/'+this.url)
                    .then(response => {

                        this.hasWish = 0;

                        console.log(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                }) 
            },
            addToWishlist() {                
        
                axios
                    .get(window.location.origin+'/'+this.url)
                    .then(response => {

                        this.hasWish = 1;

                        console.log(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                }) 
            }
        },
        mounted() { 
            
            this.hasWish = this.has;            
            
        }
    };
</script>
