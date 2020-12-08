<template>
    <div class="col col-md-2 d-block pl-md-0">

        <ais-clear-refinements>
            <div slot-scope="{ canRefine, refine, createURL }">
                <a
                class="btn btn-outline-green"
                :href="createURL()"
                @click.prevent="refine"
                v-if="canRefine"
                >
                Limpiar búsqueda
                </a>
            </div>
            </ais-clear-refinements>

        <a class="btn btn-outline-green mb-3 w-100 d-block d-md-none" 
            data-toggle="collapse" 
            href="#filtersCollapse" 
            role="button" 
            aria-expanded="false" 
            aria-controls="filtersCollapse">
            Filtrar</a>



        <div class="collapse d-md-block" id="filtersCollapse">
            <div class="card card-body mb-4 p-md-0 border-md-0">
                <ais-panel>
                    <h6 class="font-weight-bold mt-3">DEPARTAMENTO</h6>
                    <template slot="default" >
                        
                        <ais-refinement-list
                            attribute="DepName"
                            :searchable="false"
                        >
                        </ais-refinement-list>                
                    </template>
                </ais-panel>

                <ais-panel>
                    <h6 class="font-weight-bold mt-3">TIPO DE PRENDA</h6>
                    <template slot="default">
                        <ais-refinement-list
                            attribute="ClothingTypeName"
                            :searchable="false"
                        />
                    </template>
                </ais-panel>

                <ais-panel>
                    <h6 class="font-weight-bold mt-3">MARCA</h6>
                    <template slot="default">
                        <ais-refinement-list
                            attribute="BrandName"
                            :searchable="false" 
                        />
                    </template>
                </ais-panel>

                <ais-panel>
                    <h6 class="font-weight-bold mt-3">COLOR</h6>
                    <template slot="default">
                        <ais-refinement-list
                            attribute="ColorName"
                            :searchable="false"
                        />
                    </template>
                </ais-panel> 
            </div>
        </div>
    </div>                
</template>

<script>
    export default {
        data() {
            return {
                responsive: false
            }
        },
        watch: {
            responsive: function () {
                this.responsive = window.screen.width > 576;
                
            }
        }
    }
</script>


