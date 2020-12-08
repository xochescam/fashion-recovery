<template>
    <ais-search-box
        defaultRefinement="zara"
        :autofocus="false"
        attribute="busqueda">

        <form slot-scope="{ currentRefinement, refine }" @submit="onSubmit($event, refine)">

            <div class="form-inline my-2 my-lg-0 mr-auto">
                <input
                    class="form-control mr-sm-2"
                    id="query"
                    name="query" 
                    type="search"
                    ref="query"
                    placeholder="¿Qué buscas hoy?" 
                    :value="val"
                >
                <button 
                    class="btn btn-outline-light my-2 my-sm-0 mx-2" 
                    type="submit">Buscar</button>
            </div>                
        </form>
    </ais-search-box>
</template>

<script>

export default {
    props: {
        searchdata: String
    },
    data() {
        return {
            search: this.searchdata,
            val: ''
        };

    },
    mounted() {
        this.$root.$on('searchvalue', data => {
            this.val = data;
        });
    },
    methods: {
        onSubmit(event, refine) {
            event.preventDefault();         
            this.$root.$emit('searchvalue', event.currentTarget.query.value); 

            refine(event.currentTarget.query.value);
        }
    }
};
</script>