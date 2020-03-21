<template>
    <main id="main">
        <div class="row p-3 mx-0 mx-md-5">
            <h2 class="text-left TituloFR my-4 mb-5">Resultados de la búsqueda</h2>
        </div>
        
        <section>
            <div class="row p-0 p-md-3 mb-5 mx-md-5">

                <refinament-component></refinament-component>

                <ais-hits class="col-md-10 shadow-lg p-3 mb-5 bg-white rounded w-100">

                    <a  href="#" 
                        class="link-card mt-4"
                        slot="item"
                        slot-scope="{ item }">
                        <div class="card card--public card--item shadow p-3 bg-white rounded d-flex align-items-stretch h-100">
                                
                            <img class="card-img-top" :src="path+'/'+item.ThumbPath" alt="" height="200px;">
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
                </ais-hits>

            </div>
        </section>
    </main>
</template>

<script>
import algoliasearch from 'algoliasearch/lite';


export default {
    data() {
        return {
            path: this.$root.path
        }
    }
};
</script>