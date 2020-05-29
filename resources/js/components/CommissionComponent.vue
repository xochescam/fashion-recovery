<template>
    <div>
        <input 
            type="text" 
            class="form-control js-currency-input" 
            data-type="currency" 
            pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" 
            name="ActualPrice" 
            id="ActualPrice"
            :value="current" 
            @keyup="key($event.target.value)"
            required>
        <small>¿En cuánto venderás la prenda?</small>

        <div class="invalid-feedback d-block" v-if="invalid">
            {{ invalid }}
        </div>

        <div class="alert alert-success fade show mt-4 text-center" role="alert" v-if="gain && !invalid">
            Obtendrás de ganancia: <strong> $ {{ gain }} </strong>
        </div>

    </div>
</template>

<script>
export default {
    props: {

        /**
        * Receive an initial selected value.
        */
        commission: {
            type: Number,
            required: false,
            default: ''
        },
        value: {
            type: String,
            required: false,
            default: ''
        },
    },
    data() {
        return {
            gain: false,
            invalid: false,
            current : this.value,
        };
    },
    methods: {
        key(val) { 

            this.current = val;

            var actual = Number(val.replace(/[^0-9.-]+/g,""));
            this.invalid =  actual < 180 ? 
                            'El precio mínimo de la prenda debe ser $180' : false;

            this.gain = actual - (actual * this.commission);
        }
    }
};
</script>