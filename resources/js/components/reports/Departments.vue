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
                    <th scope="col">Departamento</th>
                    <th scope="col">Ventas</th>
                    <th scope="col">Ganancia FR</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in data" :key="item.name">
                    <td>{{ item.name }}</td>
                    <td>{{ item.sells }}</td>
                    <td>${{ item.gain }}</td>
                </tr>

                <tr v-if="data.length === 0">
                    <td colspan="3" class="text-center">
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
            type: Array,
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
                '/get-departments-excel' : 
                '/get-departments-period-excel/'+ini+'/'+end;
        }
        
    },
    mounted() {
    }
};
</script>