<template>
    <form 
        :action="this.$root.path+'/payment-card'" 
        method="POST" 
        id="pay" 
        name="pay" 
        ref="pay"
        novalidate
        v-on:submit.prevent="doPay">
        <input type="hidden" name="_token" :value="csrf">

        <div class="alert alert-info alert-dismissible mb-5 fade show" role="alert" v-if="in_process">
            {{ in_process }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="in_process = ''">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="alert alert-warning alert-dismissible mb-5 fade show" role="alert" v-if="rejected">
            {{ rejected }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="rejected = ''">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <input type="hidden" :value="amount" name="amount">

        <div class="px-0 mb-3">
            <label for="cardholderName">Nombre como aparece en la tarjeta</label>
            <input 
                type="text" 
                class="form-control" 
                id="cardholderName" 
                data-checkout="cardholderName" 
                placeholder="APRO"
                :class="{ 'is-invalid': $v.name.$error || invalidName }"
                v-model.trim="name"
                @input="setName($event.target.value)"
                
                required/>
            <div class="invalid-feedback" v-if="!$v.name.required">
                 El campo es obligatorio.
            </div>
            <div class="invalid-feedback" v-if="invalidName">
                El nombre de la tarjeta es inválido.
            </div>
        </div>
        
        <div class="px-0 mb-3">
            <label for="cardNumber">Número de tarjeta</label>
            <input 
                type="text" 
                id="cardNumber" 
                class="form-control" 
                data-checkout="cardNumber" 
                placeholder="4075595716483764" 
                onselectstart="return false" 
                onpaste="return false" 
                onCopy="return false" 
                onCut="return false" 
                onDrag="return false" 
                onDrop="return false" 
                autocomplete=off 
                maxlength="16"
                :class="{ 'is-invalid': ($v.cardnumber.$error || invalidCard) }"
                v-model.trim="cardnumber"
                @input="setCardNumber($event.target.value)"
                ref="cardnumber"
                required
                />
            <div class="invalid-feedback" v-if="!$v.cardnumber.required">
                 El campo es obligatorio.
            </div>
            <div class="invalid-feedback" v-if="!$v.cardnumber.maxLength"> 
                El campo no debe ser mayor a {{$v.cardnumber.$params.maxLength.max}} caracteres.
            </div>
            <div class="invalid-feedback" v-if="!$v.cardnumber.numeric"> 
                El campo debe ser un número de tarjeta.
            </div>
            <div class="invalid-feedback" v-if="invalidCard">
                Hay algo mal en ese número. Vuelve a ingresarlo.
            </div>
        </div>

         <div class="row mb-5">
             <div class="col-md-5 mb-3">
                <label for="cardExpirationMonth">Mes</label>
                <select 
                    class="form-control" 
                    id="cardExpirationMonth" 
                    data-checkout="cardExpirationMonth" 
                    placeholder="11" 
                    onselectstart="return false" 
                    onpaste="return false" 
                    onCopy="return false" 
                    onCut="return false" 
                    onDrag="return false" 
                    onDrop="return false" 
                    autocomplete=off  
                    :class="{ 'is-invalid': $v.month.$error || invalidMonth}"
                    v-model.trim="month"
                    @input="setMonth($event.target.value)"
                    required>
                    <option value="" selected>- Seleccionar -</option>
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
                <div class="invalid-feedback" v-if="!$v.month.required">
                     El campo es obligatorio.
                </div>
                <div class="invalid-feedback" v-if="invalidMonth">
                    El mes es inválido.
                </div>
            </div>
            <div class="col-md-5 mb-3">
                <label for="cardExpirationYear">Año</label>
                <select 
                    class="form-control" 
                    id="cardExpirationYear" 
                    data-checkout="cardExpirationYear" 
                    placeholder="2025" 
                    onselectstart="return false" 
                    onpaste="return false" 
                    onCopy="return false" 
                    onCut="return false" 
                    onDrag="return false" 
                    onDrop="return false" 
                    autocomplete=off 
                    :class="{ 'is-invalid': $v.year.$error || invalidYear}"
                    v-model.trim="year"
                    @input="setYear($event.target.value)"
                    required>
                    <option value="" selected>- Seleccionar -</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                </select>
                <div class="invalid-feedback" v-if="!$v.year.required">
                     El campo es obligatorio.
                </div>
                <div class="invalid-feedback" v-if="invalidYear">
                    El año es inválido.
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <label for="securityCode">CVV</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="securityCode" 
                    data-checkout="securityCode" 
                    placeholder="123" 
                    onselectstart="return false" 
                    onpaste="return false" 
                    onCopy="return false" 
                    onCut="return false" 
                    onDrag="return false" 
                    onDrop="return false" 
                    autocomplete=off 
                    required
                    maxlength="4"
                    :class="{ 'is-invalid': $v.cvv.$error || invalidCvv}"
                    v-model.trim="cvv"
                    @input="setCvv($event.target.value)"
                    />
                <div class="invalid-feedback" v-if="!$v.cvv.required">
                     El campo es obligatorio.
                </div>
                <div class="invalid-feedback" v-if="!$v.cvv.numeric"> 
                    El campo debe ser un CVV.
                </div>
                <div class="invalid-feedback" v-if="!$v.cvv.maxLength">
                    El campo no debe ser mayor a {{$v.cvv.$params.maxLength.max}} caracteres.
                </div>
                <div class="invalid-feedback" v-if="invalidCvv">
                    El cvv es inválido.
                </div>
            </div>
        </div>

        <button 
            class="btn btn-fr btn-block w-25 m-auto" 
            type="submit" 
            :disabled="isClicked || $v.$invalid">
            Pagar
        </button>
    </form>
</template>

<script>
import { validationMixin } from 'vuelidate';
import { required, maxLength, maxValue, numeric } from 'vuelidate/lib/validators'

export default {
    mixins: [ validationMixin ],
    props:{
        csrf: {
            type: String,
            required: true
        },
        /**
        * Receive an initial selected value.
        */
        shipping: {
            type: Number,
            required: false,
            default: ''
        },
        shippingcost : {
            type: Number,
            required: false,
            default: ''
        },
        amount : {
            type: Boolean,
            required: false,
            default: ''
        },
    },
    validations: {
        cardnumber: {
            required,
            numeric,
            maxLength: maxLength(16)
        },
        month: {
            required
        },
        year: {
            required
        },
        cvv: {
            required,
            numeric,
            maxLength: maxLength(4)
        },
        name: {
            required
        },
    },
    data() {
        return {
            doSubmit: false,
            paymentMethodId: '',
            isClicked: false,
            cardnumber: '',
            month: '',
            year: '',
            cvv: '',
            name: '',
            invalidCard: false,
            invalidName: false,
            invalidMonth: false,
            invalidYear: false,
            invalidCvv: false,
            rejected: '',
            in_process: ''
        };
    },
    methods : {
        setCardNumber(value){
            this.guessingPaymentMethod()
            this.cardnumber = value
            this.$v.cardnumber.$touch()
        },
        setMonth(value){
            this.month = value
            this.$v.month.$touch()
        },
        setYear(value){
            this.year = value
            this.$v.year.$touch()
        },
        setCvv(value){
            this.cvv = value
            this.$v.cvv.$touch()
        },
        setName(value){
            this.name = value
            this.$v.name.$touch()
        },
        doPay(event) {
            if(!this.doSubmit && !this.$v.$invalid) {
                $("#loader-payment").modal({
                    backdrop: "static",
                    keyboard: false,
                    show: true
                });
                
                this.isClicked = true;

                var $form = document.querySelector('#pay');
                window.Mercadopago.createToken($form, this.sdkResponseHandler); 
            } 
        },
        setValidation(code) {

            if(code == "316") {
                this.invalidName = true;

            } else if(code == "325") {
                this.invalidMonth = true;

            } else if(code == "326") {
                this.invalidYear = true;

            } else if(code == "E301") {
                this.invalidCard = true;

            } else if(code == "E302") {
                this.invalidCvv = true;

            }
        },
        sdkResponseHandler(status, response) {

            if (status != 200 && status != 201) {

                response.cause.forEach(element => {
                    this.setValidation(element.code);
                });

                this.reset();
            } else {            
                
                const data = {
                    "token" : response.id,
                    "paymentMethodId" : this.paymentMethodId,
                    "shipping" : this.shipping
                };

                axios
                    .post(this.$root.path+'/payment-card',data)
                    .then(response => {

                        if(response.status === 200 || response.status === 201){

                            if(response.data['status'] === 'approved') {

                                this.saveData();

                            } else if(response.data['status'] === 'in_process') {

                                this.in_process = response.data['message'];
                                this.reset();

                            } else if(response.data['status'] === 'rejected') {

                                this.rejected = response.data['message'];
                                this.reset();
                            }

                        } else {
                            
                            this.reset();
                        } 
                    })
                    .catch(error => {
                        this.reset();
                        console.log(error)
                    }) 
            }
        },
        saveData() {
            axios
                .get(this.$root.path+'/confirmation/'+this.shipping)
                .then(response => {
                    window.location.href = this.$root.path+'/summary/'+this.shipping+'/';                    
                }).catch(error => {
                    this.reset();
                })
        },
        reset() {
            Mercadopago.clearSession();
            this.isClicked = false;
            $(".js-loader-payment").modal("hide");
            $(".modal-backdrop").remove();
            $('body').removeClass('modal-open');
            $("#loader-payment").hide();
        },
        guessingPaymentMethod() {
            var bin = this.getBin();

            if (bin.length >= 6) {
                window.Mercadopago.getPaymentMethod({
                    "bin": bin
                }, this.setPaymentMethodInfo);
            }
        },
        getBin() {
            return this.$refs.cardnumber.value.substring(0,6);
        },
        setPaymentMethodInfo(status, response) {
            if (status == 200) {
                this.paymentMethodId = response[0].id;
            } else {
                this.invalidCard = false;
                this.reset();
            }
        },
        
    },
    mounted() {
        console.log(this.csrf);
        
    }
};
</script>