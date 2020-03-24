<template>
    <ais-instant-search
        :search-client="searchClient"
        index-name="fashionrecovery.GR_029"
    >

    <ais-configure v-bind="initial" :distinct="true"/>

    <header-component
        :authdata="auth"
        :countitemsdata="countitems"
        :notificationsdata="notifications"
        :sellerurl="sellerurl"
        :instantsearch="true"
        :searchdata="search"
    ></header-component>

    <hits></hits>

  </ais-instant-search>
</template>

<script>
import algoliasearch from 'algoliasearch/lite';


export default {
    props: {
        searchdata: String,
        sellerurl: String,
        authdata: Object,
        countitemsdata: Number,
        notificationsdata: Array
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
                },
            },
            auth: this.authdata,
            countitems: this.countitemsdata,
            notifications: this.notificationsdata,
            search: this.searchdata
        };

    }
};
</script>