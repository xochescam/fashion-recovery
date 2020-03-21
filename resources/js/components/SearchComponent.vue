<template>
    <ais-instant-search
        :search-client="searchClient"
        index-name="fashionrecovery.GR_029"
    >

    <header-component
        sellerurl="sellerurl"
    ></header-component>

    <hits-component></hits-component>

  </ais-instant-search>
</template>

<script>
import algoliasearch from 'algoliasearch/lite';

export default {
    props: {
        sellerurl: String
    },
    data() {
        return {
            searchClient: algoliasearch(
                '6Q41U13M1N',
                'df012de4c484202f7dba5a84549acfa3'
            ),
        };
    }
};
</script>