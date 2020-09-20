<template>
    <div>
        <div class="row">
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card light-bg">
                    <div class="card-body card--reports">
                        <p class="card-text">
                            <strong>Total de ganancias</strong>
                        </p>
                        <hr>
                        <p class="card-title h4 green-color mb-0">
                            ${{ data['gain'] }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card light-bg">
                    <div class="card-body card--reports">
                        <p class="card-text"> 
                            <strong>Número de ventas</strong> 
                        </p>
                        <hr>
                        <p class="card-title h4 green-color mb-0">
                            {{ data['sold'] }}
                        </p>

                        <a 
                            class="btn btn-sm btn-outline-green float-right" 
                            @click="$parent.showReport(7)">
                            Ver más
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card light-bg">
                    <div class="card-body card--reports">
                        <p class="card-text"> 
                            <strong>Departamento más vendido</strong> 
                        </p>
                        <hr>
                        <p class="card-title h4 green-color mb-0">
                            {{ data['department'] }}
                        </p>

                        <a 
                            class="btn btn-sm btn-outline-green float-right" 
                            @click="$parent.showReport(4)">
                            Ver más
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card light-bg">
                    <div class="card-body card--reports">
                        <p class="card-text"> 
                            <strong>Compradores</strong> 
                            <span class="badge badge-success float-right">
                                {{ data['buyers'] }}
                            </span>
                        </p>
                        <hr>
                        <p class="card-title green-color mb-0">
                            <strong>
                                Generalmente compran {{ data['genderBuyers'] === 'Masculino' ? 'hombres' : 'mujeres' }} 
                                alrededor de {{ data['ageBuyers'] }} años.
                            </strong>
                        </p>
                        <a 
                            class="btn btn-sm btn-outline-green float-right" 
                            @click="$parent.showReport(2)">
                            Ver más
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card light-bg">
                    <div class="card-body card--reports">
                        <p class="card-text"> 
                            <strong>Costo promedio por envío</strong> 
                        </p>
                        <hr>
                        <p class="card-title h4 green-color mb-0">
                            {{ data['shippingProm'] }}
                        </p>
                        <a 
                            class="btn btn-sm btn-outline-green float-right" 
                            @click="$parent.showReport(3)">
                            Ver más
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card light-bg">
                    <div class="card-body card--reports ">
                        <p class="card-text"> 
                            <strong>Tipo de prenda más vendida</strong> 
                        </p>
                        <hr>
                        <p class="card-title h4 green-color mb-0">
                            {{ data['clothingType'] }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card light-bg">
                    <div class="card-body card--reports">
                        <p class="card-text"> 
                            <strong>Vendedores</strong> 
                            <span class="badge badge-success float-right">
                                {{ data['sellers'] }}
                            </span>
                        </p>
                        <hr>
                        <p class="card-title green-color mb-0">
                            <strong>
                                Generalmente venden {{ data['genderSellers'] === 'Masculino' ? 'hombres' : 'mujeres' }} 
                                alrededor de {{ data['ageSellers'] }} años.
                            </strong>
                        </p>

                        <a 
                            class="btn btn-sm btn-outline-green float-right" 
                            @click="$parent.showReport(6)">
                            Ver más
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card light-bg">
                    <div class="card-body card--reports">
                        <p class="card-text"> 
                            <strong>Número de devoluciones</strong> 
                        </p>
                        <hr>
                        <p class="card-title h4 green-color mb-0">
                            {{ data['devolutions'] }}
                        </p>

                        <a 
                            class="btn btn-sm btn-outline-green float-right" 
                            @click="$parent.showReport(5)">
                            Ver más
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card light-bg">
                    <div class="card-body card--reports">
                        <p class="card-text"> 
                            <strong>...</strong> 
                        </p>
                        <hr>
                        <p class="card-title h4 green-color mb-0">
                            ...
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        data: {
            type: Object,
            required: true
        },
    },
    data() {
        return {
            BrandID: "",
            searching: false,
            DepartmentID: ""
        };
    },
    methods: {
        filter() {

        }
    },
    mounted() {
    }
};
</script>