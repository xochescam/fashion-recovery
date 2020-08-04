<template>

<nav id="header" class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" :href="this.$root.path">
      <img :src="this.$root.path+'/img/header/transparent_logo.png'" alt="Fashion Recovery"/>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" 
    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
    aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    
        <search-input 
            :searchdata="search"
            v-if="instantsearch"></search-input>

        <div class="form-inline my-2 my-lg-0 mr-auto" v-else>
            <input
                class="form-control mr-sm-2"
                name="search" 
                type="search"
                ref="search"
                placeholder="¿Qué buscas hoy?" 
                v-on:keyup.enter="searchPage"
            >
            <button 
                class="btn btn-outline-light my-2 my-sm-0 mx-2" 
                type="button"
                @click="searchPage"
                >Buscar</button>
        </div>   

        <ul class="navbar-nav ml-auto" >
            <li class="nav-item" v-if="!auth.id || (sellerurl && canbuyitem)">
                <a class="nav-link" :href="sellerurl">
                    ¿Quieres vender?
                </a>
            </li>
    
            <a class="nav-link order-1 order-sm-2 text-left text-sm-center pl-2 pl-sm-0" 
                :href="this.$root.path+'/shopping-cart'" 
                role="button" 
                aria-haspopup="true" 
                aria-expanded="false"
                v-if="auth.id && canbuyitem">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="badge badge-pill badge-light badge-notifications">{{ countitems }}</span>
                    <span class="ml-1 d-inline-block d-sm-none">Carrito</span>
            </a>


            <li class="nav-item dropdown order-3 order-sm-3">
                <a class="nav-link dropdown-toggle float-left float-sm-none dropdown-option pl-2 pl-sm-0 text-left" 
                    id="navbarDropdown" role="button" data-toggle="dropdown" 
                    aria-haspopup="true" aria-expanded="false"
                    v-if="auth.id">
                    <i class="fas fa-user d-inline-block d-sm-none"></i>
                    <span class="ml-1">{{ auth.Alias }}</span>
                    
                </a>

                <div class="dropdown-menu bg-light size-14 mt-sm-3" aria-labelledby="navbarDropdown" v-if="auth.id">
                    <a class="dropdown-item text-left bg-light" :href="this.$root.path+'/account'" v-if="canpersonalinfo">Mi Cuenta</a>
                    <a  class="dropdown-item text-left bg-light" :href="this.$root.path+'/sales'" v-if="auth.id  && canitem">Mis Ventas</a>
                    <a class="dropdown-item text-left bg-light" :href="this.$root.path+'/wallet'" v-if="canorders">Mi Cartera</a>
                    <a class="dropdown-item text-left bg-light" :href="this.$root.path+'/orders'" v-if="canorders">Mis Pedidos</a>
                <!--     <a class="dropdown-item text-left" href="{{ url('sells') }}">Mis ventas</a>
                -->
                    <div class="dropdown-divider" 
                        v-if="auth.id && (canitem || canwishlist)">
                    </div>
                    <a  class="dropdown-item text-left bg-light" 
                        :href="this.$root.path+'/item'"
                        v-if="auth.id && canitem">Subir Prenda</a>
                    <a  class="dropdown-item text-left bg-light" 
                        :href="this.$root.path+'/guardarropa'"
                        v-if="auth.id  && canitem">Mi Clóset</a>
                    <a  class="dropdown-item text-left bg-light" 
                        :href="this.$root.path+'/wishlists'"
                        v-if="auth.id  && canwishlist">Mis Favoritos</a>
                <!--     <a class="dropdown-item text-left" href="{{ url('followers') }}">Mis seguidores</a> -->

                    <div class="dropdown-divider" 
                        v-if="auth.id && cancategory && canitem">
                    </div>
                    <a  class="dropdown-item text-left bg-light" 
                        :href="this.$root.path+'/dashboard'"  
                        v-if="auth.id && cancategory">Administración</a>


                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-left bg-light" :href="this.$root.path+'/update-password'">Cambiar contraseña</a>
                    <a class="dropdown-item text-left bg-light" :href="this.$root.path+'/logout'">Cerrar sesión</a>
                </div>
            </li>


            <notifications
                v-if="auth.id && cannotifications"
                :notifications="this.notifications"
            ></notifications>

            <li class="nav-item active" v-if="!auth.id">
                <a class="nav-link" :href="this.$root.path+'/login/0'">Iniciar sesión</a>
            </li>    
        </ul>    

    </div>
  </div>
</nav>

</template>

<script>

export default {
    props: {
        cancategory: String,
        canseller: String,
        canbuyitem: String,
        canpersonalinfo: String,
        canorders: String,
        canitem: String,
        canwishlist: String,
        cannotifications: String,
        instantsearch: Boolean,
        sellerurl: String,
        authdata: Object,
        countitemsdata: Number,
        notificationsdata: Array,
        searchdata: String
    },
    data() {
        return {
            auth: this.authdata,
            countitems: this.countitemsdata,
            notifications: this.notificationsdata,
            search: this.searchdata
        };

    },
    methods: {
        searchPage() {
            var val = this.$refs.search.value;

            if(!val) {
                return;
            }

            window.location.href = this.$root.path+'/search/'+val;
        }
    },
};
</script>