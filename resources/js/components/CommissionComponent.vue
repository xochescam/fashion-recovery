<template>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="OriginalPrice">Precio Original *</label>
            <input 
                type="text" 
                class="form-control js-currency-input" 
                data-type="currency" 
                pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" 
                name="OriginalPrice" 
                id="OriginalPrice" 
                :value="orig"
                ref="original"
                @keyup="checkPrice($event.target.value)"
                required>
            <small>¿Cuánto te costo la prenda?</small>

            <div class="invalid-validation" v-for="error in errors['OriginalPrice']" :key="error">
                {{ error  }}
            </div>

            <div class="invalid-feedback">
                El campo precio original es obligatorio.
            </div>

            <div class="invalid-validation" v-if="wrongPrice">
                El Precio Original debe ser mayor al Precio Fashion Recovery.
            </div>
        </div> 

        <div class="form-group col-md-6">
            <label for="ActualPrice">Precio Fashion Recovery *</label>
            <input 
                type="text" 
                class="form-control js-currency-input" 
                data-type="currency" 
                pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" 
                name="ActualPrice" 
                id="ActualPrice"
                :value="current" 
                ref="current" 
                @keyup="key($event.target.value)"
                required>
            <small>¿En cuánto venderás la prenda?</small>

            <div class="invalid-validation" v-if="invalid">
                {{ invalid }}
            </div>

            <div class="invalid-validation" v-for="error in errors['ActualPrice']" :key="error" >
                {{ error }}
            </div>

            <div class="invalid-feedback" >
                El campo Precio Fashion Recovery es obligatorio.
            </div>

            <div class="alert alert-success fade show mt-4 text-center" role="alert" v-if="gain && !invalid && !wrongPrice">
                <span class="mb-2"> Obtendrás de ganancia: <strong> $ {{ gain }} </strong> </span> <br>
                <small class="text-dark" > Para más información visita <a class="text-dark underlined" :href="$root.path+'/terms#commission'">Términos y Condiciones</a> </small>
            </div>
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
            required: false
        },
        actual: {
            type: String,
            required: false
        },
        original: {
            type: String,
            required: false
        },
        errors: {
            type: [Object, Array],
            required: false
        },
    },
    data() {
        return {
            gain: false,
            invalid: false,
            current : this.actual,
            orig : this.original,
            wrongPrice : false
        };
    },
    methods: {
        key(val) { 

            this.checkPrice(this.$refs.original.value);

            this.current = val;
            this.orig = this.$refs.original.value;

            var actual = Number(val.replace(/[^0-9.-]+/g,""));
            this.invalid =  actual < 180 ? 
                            'El precio mínimo de la prenda debe ser $180' : false;

            this.gain = actual - (actual * this.commission);
        },
        checkPrice(val) {

            let current = this.$refs.current.value;

            if(current === '') {
                return;
            }

            let original = Number(val.replace(/[^0-9.-]+/g,""));
            current      = Number(current.replace(/[^0-9.-]+/g,""));

            this.wrongPrice = original < current ? true : false;

            this.current = this.$refs.current.value;
            this.orig = val;
        }
    },
    mounted() {
        console.log(this.errors)
    }
};
</script>