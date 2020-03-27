<template>
    <main id="main">
        <div class="container pt-4">
            <h2 class="text-left TituloFR my-4 mb-5">Resultados de la búsqueda</h2>
        </div>
        
        <section class="container">
            <div class="row p-0 mb-5">

                <refinament></refinament>

                <ais-hits class="col-md-10 shadow-lg p-3 mb-5 bg-white rounded w-100">

                    <div slot="item"
                        slot-scope="{ item }"
                        class="position-relative">

                        <heart-wishlist-component
                            :has="inWishlist(item.ItemID)"
                            :url="getURL(item.ItemID)"
                            type="card"
                        ></heart-wishlist-component>

                        <a :href="path+'/items/'+item.ItemID+'/public'" 
                            class="link-card mt-4">
                            <div 
                            class="card card--public card--item shadow p-3 bg-white rounded d-flex align-items-stretch h-100">
                                    
                            
                                <img class="card-img-top" :src="path+'/storage/'+item.ThumbPath" alt="" height="200px;">
                                <div class="card-body px-0 p-lg-3">
                                        
                                    <h4 class="card-title mb-0">
                                        {{ item.BrandName }}
                                    </h4>

                                    <div class="float-right">
                                        <span class="mr-2 text-black-50">
                                            <del>{{ item.OriginalPrice }}</del>
                                        </span>
                                        <p class="badge alert-success badge-price">
                                            {{ item.ActualPrice }}
                                        </p>
                                    </div>
                                            
                                    <div class="container-fade txt-fade">
                                        <p>{{ item.ItemDescription }}</p>
                                    </div>

                                    <p class="card-text" style="border-bottom: 1px solid gray; border-top: 1px solid gray;">
                                        Talla: {{ item.SizeName }}
                                        <br/>Color: {{ item.ColorName }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                </ais-hits>

            </div>
        </section>
    </main>
</template>

<script>
import algoliasearch from 'algoliasearch/lite';


export default {
    props: {
        wishlistdata: Object,
        authdata: Object
    },
    data() {
        return {
            path: this.$root.path,
            wishlist: this.wishlistdata,
            auth: this.authdata
        }
    },
    methods: {
        inWishlist(id) {
            var arr = this.wishlist.wishlistdata;

            for (let index = 0; index < arr.length; index++) {
                const element = arr[index].ItemID;

                if(element === id) {
                    return 'true';
                }                
            }
        },
        getURL(id) {
            const inWish = this.inWishlist(id);
            const wishlist = this.wishlist.wishlistdata;

            return !this.auth.id ? 'login/0' :
                    (this.wishlist.wishlistdata.length === 0 ? 'wishlist/'+id+'/create' : 
                    (inWish ? 
                    'wishlist/'+wishlist[0].WishListID+'/'+id+'/delete':
                    'wishlist/'+wishlist[0].WishListID+'/'+id+'/add'));
        }
    }
};
</script>