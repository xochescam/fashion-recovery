<template>

<nav id="header" class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" :href="this.$root.path">
      <img :src="this.$root.path+'/img/header/transparent_logo.png'" alt="Fashion Recovery"/>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ais-search-box>
            <div class="form-inline my-2 my-lg-0 mr-auto"  
                slot-scope="{ currentRefinement, isSearchStalled, refine }">
                <input
                class="form-control mr-sm-2"
                type="search"
                placeholder="¿Qué buscas hoy?" 
                v-model="currentRefinement"
                @input="refine($event.currentTarget.value)"
                >
                <span :hidden="!isSearchStalled">Loading...</span>
            </div>
        </ais-search-box>

        <ul class="navbar-nav ml-auto" v-if="sellerurl">
            <li class="nav-item">
                <a class="nav-link" :href="sellerurl">
                    ¿Quieres vender?
                </a>
            </li>
    
            <!-- @include('dashboard.auth-menu') -->
            <li class="nav-item active" >
                <a class="nav-link" :href="this.$root.path+'login/0'">Iniciar sesión</a>
            </li>    
        </ul>    

    </div>
  </div>
</nav>

</template>

<script>
import algoliasearch from 'algoliasearch/lite';

export default {
    props: {
        sellerurl: String
    },
    mounted() {

        console.log(this.sellerurl);
    }
};
</script>