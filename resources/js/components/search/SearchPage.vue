<template>
    <ais-instant-search
        :search-client="searchClient"
        index-name="fashionrecovery.GR_029"
    >

    <ais-configure v-bind="initial" :distinct="true"/>

    <header-component
        :cancategory="cancategory"
        :canseller="canseller"
        :canbuyitem="canbuyitem"
        :canpersonalinfo="canpersonalinfo"
        :canorders="canorders"
        :canitem="canitem"
        :canwishlist="canwishlist"
        :cannotifications="cannotifications"
        :authdata="auth"
        :countitemsdata="countitems"
        :notificationsdata="notifications"
        :sellerurl="sellerurl"
        :instantsearch="true"
        :searchdata="search"
    ></header-component>

    <hits 
        :wishlistdata="{ wishlistdata }"
        :authdata="auth"
        :searchdata="searchdata"
        ></hits>

  </ais-instant-search>
</template>

<script>
import algoliasearch from 'algoliasearch/lite';


export default {
    props: {
        wishlistdata: Array,
        searchdata: String,
        sellerurl: String,
        authdata: Object,
        countitemsdata: Number,
        notificationsdata: Array,
        cancategory: String,
        canseller: String,
        canbuyitem: String,
        canpersonalinfo: String,
        canorders: String,
        canitem: String,
        canwishlist: String,
        cannotifications: String,
        brands: String,
    },
    data() {
        return {
            searchClient: algoliasearch(
                process.env.MIX_ALGOLIA_APP_ID,
                process.env.MIX_ALGOLIA_SEARCH
            ),
            initial: {
                query: this.searchdata,
                disjunctiveFacetsRefinements: {
                    DepName: ['Hombres', 'Mujeres', 'Niños', 'Maternidad'].includes(this.searchdata) 
                            ? [this.searchdata] : false,
                    BrandName: JSON.parse(this.brands).includes(this.searchdata) 
                            ? [this.searchdata] : false,
                },
            },
            auth: this.authdata,
            countitems: this.countitemsdata,
            notifications: this.notificationsdata,
            search: this.searchdata,
            arrBrands:JSON.parse(this.brands)
        };
    },
    mounted() {
    }
};
</script>