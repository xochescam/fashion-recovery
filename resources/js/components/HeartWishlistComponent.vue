<template>
    <div class="dropdown">
        <a v-if="initial" @click="removeFromWishlist()">
            <i class="fas fa-heart heart-wishlist heart-wishlist--active"></i>
        </a>

        <a href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" 
            v-else>
            <i class="far fa-heart heart-wishlist"></i>
        </a>
        
        <div class="dropdown-menu top-60 w-100" aria-labelledby="dropdownMenuButton" v-if="!initial">
            <a class="dropdown-item text-left"
                v-for="wishlist in allWishlists" 
                :key="wishlist.WishListID"
                :value="wishlist.NameList" 
                @click="addToWishlist(wishlist.WishListID)">  
            {{ wishlist.NameList }} </a>

            <a  class="dropdown-item dropdown-item--green text-left green-color" 
                href="#" 
                data-toggle="modal" 
                :data-target="'#addWishlist-'+(item )" 
            >
                <i class="fas fa-plus"></i>
                <b class="ml-1">Nueva wishlist</b>
            </a>
        </div>  
    </div>
</template>

<script>
    export default {

        props: {

            /**
             * Receive an initial selected value.
             */
            initial: {
                type: String,
                required: false,
                default: ''
            },
            /**
             * Receive an initial selected value.
             */
            wishlists: {
                type: Object,
                required: false,
                default: ''
            },
            /**
             * Receive an initial selected value.
             */
            item: {
                type: String,
                required: false,
                default: ''
            },
            /**
             * Receive an initial selected value.
             */
            wish: {
                type: String,
                required: false,
                default: ''
            },
        },
         data() {
            return {
                allWishlists: []
            };
        },
        methods: {
            removeFromWishlist() {    
                console.log(this.wish);

                window.axios
                    .get('wishlist/'+Number(this.wish)+'/'+Number(this.item)+'/delete')
                    .then(response => {

                        this.initial = false;

                        console.log(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                }) 
            },
            addToWishlist(WishListID) {
        
                window.axios
                    .get('wishlist/'+Number(WishListID)+'/'+Number(this.item)+'/add')
                    .then(response => {

                        this.initial = true;

                        console.log(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                }) 
            }
        },
        mounted() {
            
            this.allWishlists = this.wishlists ? JSON.parse(this.wishlists) : [];  
        }
    };
</script>
