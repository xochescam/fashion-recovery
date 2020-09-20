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
                    <th scope="col">..</th>
                    <th scope="col">..</th>
                    <th scope="col">..</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        ...
                    </td>
                    <td>...</td>
                    <td>...</td>
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
                '/get-sells-excel' : 
                '/get-sells-period-excel/'+ini+'/'+end;
        }
    },
    mounted() {
    }
};
</script>