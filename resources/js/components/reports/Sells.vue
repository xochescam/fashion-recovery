<template>
    <div>
        <a 
            :href="this.$root.path+url"
            type="button" 
            class="btn btn-fr btn-sm float-right mb-4 mr-2">
            <i class="fas fa-file-excel"></i>
            Descargar Excel
        </a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Fecha</th>
                    <th scope="col">Vendedor</th>
                    <!-- <th scope="col">Nivel vendedor</th>
                    <th scope="col">Sexo</th>
                    <th scope="col">Edad</th>
                    <th scope="col">Ciudad</th> 
                    <th scope="col">Tipo de prenda</th>-->
                    <th scope="col">Importe venta</th>
                    <th scope="col">Comisión FR</th>
<!--                     <th scope="col">Ganancia vendedor</th>
 -->                    <th scope="col">Costo envio FR</th>
                    <th scope="col">Costo por transacción</th>
<!--                     <th scope="col">Ganancia total</th>
 -->                </tr>
            </thead>
            <tbody>
                <tr v-for="item in data" :key="item.alias">
                    <td>{{ item.date }}</td>
                    <td>{{ item.alias }}</td>
                    <!-- <td>{{ item.level }}</td>
                    <td>{{ item.gender }}</td>
                    <td>{{ item.age }}</td>
                    <td>{{ item.livein }}</td>
                    <td>{{ item.type }}</td> -->
                    <td>{{ item.import }}</td>
                    <td>${{ item.comission }}</td>
<!--                     <td>${{ item.gainSeller }}</td>
 -->                    <td>${{ item.transaction }}</td>
                    <td>{{ item.shipping }}</td>
<!--                     <td>${{ item.gainFR }}</td>
 -->                </tr>

                <tr v-if="data.length === 0">
                    <td colspan="13" class="text-center">
                        <span 
                            class="spinner-border spinner-border-sm spinner-border--green spinner-border--auto" 
                            role="status" 
                            aria-hidden="true"
                            v-if="$parent.isLoading">
                        </span>

                        <span v-else>Sin resultados</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    props: {
        data: {
            type: [Array,Object],
            required: true
        },
    },
    data() {
        return {
            url: this.getUrl()
        };
    },
    methods: {
        getUrl() {
            const ini = this.$parent.getData().ini;
            const end = this.$parent.getData().end;

            return this.$parent.isToday ? 
                '/get-sells-excel' : 
                '/get-sells-period-excel/'+ini+'/'+end;
        }
    },
    mounted() {
    }
};
</script>