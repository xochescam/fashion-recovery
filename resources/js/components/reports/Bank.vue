<template>
    <div>
        <div class="d-flex w-auto justify-content-between mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" @click="filter($event)">
                <label class="form-check-label" for="defaultCheck1" >
                    Transferencias pendientes
                </label>
            </div>

            <a 
                :href="this.$root.path+url"
                type="button" 
                class="btn btn-fr btn-sm float-right mb-4 mr-2">
                <i class="fas fa-file-excel"></i>
                Descargar Excel
            </a>
		</div>

       
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Fecha de solicitud de pago</th>    
                    <th scope="col">Nombre</th>
                    <th scope="col">Banco </th>
                    <th scope="col">CLABE</th>
                    <th scope="col">Monto</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, key) in data" :key="item.alias">
                    <td>{{ item.transDate }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.bank }}</td>
                    <td>{{ item.clabe }}</td>
                    <td>{{ item.amount }}</td>
                    <td>
                        <a 
                            @click="sendEmail(item, key)"
                            class="btn btn-outline-green btn-sm" 
                            v-if="item.IsTransfer && !item.IsPaid">
                            Realizada 
                        </a>
                        <span class="green-color" v-else-if="!item.IsTransfer && item.IsPaid"> 
                            <i class="fas fa-check"></i>
                        </span>
                    </td>
                </tr>

                <tr v-if="data.length === 0">
                    <td colspan="6" class="text-center">
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
            url: this.getUrl(),
            datos: this.$parent.arrBank
        };
    },
    methods: {
        getUrl() {
            const ini = this.$parent.getData().ini;
            const end = this.$parent.getData().end;

            return this.$parent.isToday ? 
                '/get-transactions-excel' : 
                '/get-transactions-period-excel/'+ini+'/'+end;
        },
        filter(e) {
            if(e.currentTarget.checked) {
                this.$parent.arrBank = this.$parent.arrBank.filter((el) =>
                    el['IsTransfer']
                );
            } else {
                this.$parent.arrBank = this.$parent.banklist;
            }
        },
        sendEmail(item, key) {
            
            axios
                .post(this.$root.path+'/enviar-notificacion',{

                    "alias" : item.alias,
                    "type" : 'transferencia',
                })
                .then(response => {

                    if(response.data.message === "success") {
                        this.data[key].IsPaid = true;
                        this.data[key].IsTransfer = false;
                    }   
                })
                .catch(error => {
                    this.isLoading = false;
                }) 
        }
    },
    mounted() {
    }
};
</script>