<template>
    <div ref="childForm">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="Alias" class="col-form-label">Alias * </label>
                <input 
                    type="text" 
                    class="form-control"
                    :class="{ 'is-invalid': $v.alias.$error || errors.Alias  }" 
                    @input="setAlias($event.target.value)" 
                    name="Alias" 
                    id="Alias" 
                    v-model.trim="alias" 
                    maxlength="50"
                    required>
                <small>¿Cómo identificarás está dirección?</small>

                <div class="invalid-feedback" 
                    v-for="(error, x) in errors.Alias" :key="x" :value="error">
                    {{ error }}
                </div>

                <div class="invalid-feedback" v-if="!$v.alias.required">El campo es obligatorio.</div>
                <div class="invalid-feedback" v-if="!$v.alias.maxLength"> El campo no debe ser mayor a {{$v.alias.$params.maxLength.max}} caracteres.</div>
            </div>

            <div class="form-group col-md-6">
                <label for="Street" class="col-form-label">Calle *</label>
                <input 
                    type="text" 
                    class="form-control" 
                    :class="{ 'is-invalid': $v.street.$error || errors.Street  }" 
                    @input="setStreet($event.target.value)" 
                    v-model.trim="street" 
                    name="Street" 
                    id="Street" 
                    maxlength="50" 
                    required>

                <div class="invalid-feedback" 
                    v-for="(error, x) in errors.Street" :key="x" :value="error">
                    {{ error }}
                </div>

                <div class="invalid-feedback" v-if="!$v.street.required">El campo es obligatorio.</div>
                <div class="invalid-feedback" v-if="!$v.street.maxLength"> El campo no debe ser mayor a {{$v.street.$params.maxLength.max}} caracteres.</div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="Ext" class="col-form-label">Núm. Exterior *</label>
                <input 
                    type="Ext" 
                    class="form-control" 
                    :class="{ 'is-invalid': $v.ext.$error || errors.Ext }" 
                    @input="setExt($event.target.value)" 
                    v-model.trim="ext" 
                    name="Ext" 
                    id="Ext" 
                    maxlength="50" 
                    required>

                <div class="invalid-feedback" 
                    v-for="(error, x) in errors.Ext" :key="x" :value="error">
                    {{ error }}
                </div>

                <div class="invalid-feedback" v-if="!$v.ext.required">El campo es obligatorio.</div>
                <div class="invalid-feedback" v-if="!$v.ext.maxLength"> El campo no debe ser mayor a {{$v.ext.$params.maxLength.max}} caracteres.</div>
            </div>

            <div class="form-group col-md-6">
                <label for="Int" class="col-form-label">Núm. Interior </label>
                <input 
                    type="text" 
                    class="form-control" 
                    :class="{ 'is-invalid': $v.int.$error || errors.Int }" 
                    @input="setInt($event.target.value)" 
                    v-model.trim="int"
                    name="Int" 
                    maxlength="50" 
                    id="Int">

                <div class="invalid-feedback" 
                    v-for="(error, x) in errors.Int" :key="x" :value="error">
                    {{ error }}
                </div>
                
                <div class="invalid-feedback" v-if="!$v.int.maxLength"> El campo no debe ser mayor a {{$v.int.$params.maxLength.max}} caracteres.</div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="Suburb" class="col-form-label">Colonia *</label>
                <input 
                    type="Suburb" 
                    class="form-control" 
                    :class="{ 'is-invalid': $v.suburb.$error || errors.Suburb }" 
                    @input="setSuburb($event.target.value)" 
                    v-model.trim="suburb"
                    name="Suburb" 
                    id="Suburb" maxlength="50" required>

                <div class="invalid-feedback" 
                    v-for="(error, x) in errors.Suburb" :key="x" :value="error">
                    {{ error }}
                </div>
                
                <div class="invalid-feedback" v-if="!$v.ext.required">El campo es obligatorio.</div>
                <div class="invalid-feedback" v-if="!$v.suburb.maxLength"> El campo no debe ser mayor a {{$v.suburb.$params.maxLength.max}} caracteres.</div>
           </div>

            <div class="form-group col-md-6">
                <label for="ZipCode" class="col-form-label">Código postal *</label>
                <input 
                    type="text" 
                    class="form-control" 
                    :class="{ 'is-invalid': $v.zipcode.$error || errors.ZipCode }" 
                    @input="setZipcode($event.target.value)" 
                    v-model.trim="zipcode"
                    name="ZipCode" 
                    id="ZipCode" maxlength="5" required>
                <small>Ej. 23000</small>

                <div class="invalid-feedback" 
                    v-for="(error, x) in errors.ZipCode" :key="x" :value="error">
                    {{ error }}
                </div>
                
                <div class="invalid-feedback" v-if="!$v.zipcode.required">El campo es obligatorio.</div>
                <div class="invalid-feedback" v-if="!$v.zipcode.numeric">El campo debe ser un código postal.</div>
                <div class="invalid-feedback" v-if="!$v.zipcode.maxLength">El campo no debe ser mayor a {{$v.zipcode.$params.maxLength.max}} caracteres.</div>                
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="State" class="col-form-label">Estado *</label>
                <select 
                    name="State" 
                    id="State" 
                    class="form-control" 
                    :class="{ 'is-invalid': $v.state.$error || errors.State }" 
                    @input="setState($event.target.value)" 
                    v-model.trim="state"
                    required>
                    <option value="" selected>- Seleccionar -</option>
                    <option v-for="(state, x) in states" :key="x" :value="state">{{ state }}</option> 
                </select>

                <div class="invalid-feedback" 
                    v-for="(error, x) in errors.State" :key="x" :value="error">
                    {{ error }}
                </div>
                
                <div class="invalid-feedback" v-if="!$v.state.required">El campo es obligatorio.</div>
                <div class="invalid-feedback" v-if="!$v.state.maxLength">El campo no debe ser mayor a {{$v.state.$params.maxLength.max}} caracteres.</div>                
           </div>

            <div class="form-group col-md-6">
                <label for="City" class="col-form-label">Municipio / Alcaldía *</label>
                <input 
                    type="text" 
                    class="form-control" 
                    :class="{ 'is-invalid': $v.city.$error || errors.City }" 
                    @input="setCity($event.target.value)" 
                    v-model.trim="city"
                    name="City" 
                    id="City" maxlength="50" required>

                <div class="invalid-feedback" 
                    v-for="(error, x) in errors.City" :key="x" :value="error">
                    {{ error }}
                </div>
                
                <div class="invalid-feedback" v-if="!$v.city.required">El campo es obligatorio.</div>
                <div class="invalid-feedback" v-if="!$v.city.maxLength">El campo no debe ser mayor a {{$v.city.$params.maxLength.max}} caracteres.</div>                
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="PhoneContact" class="col-form-label">Teléfono *</label>
                <input 
                    type="tel" 
                    class="form-control" 
                    :class="{ 'is-invalid': $v.tel.$error || errors.PhoneContact }" 
                    @input="setTel($event.target.value)" 
                    v-model.trim="tel"
                    name="PhoneContact" 
                    ref="phoneContact" 
                    id="PhoneContact" 
                    placeholder="5212000000" 
                    maxlength="10" required>
                <small>{{ count(10, $v.tel.$model.length) }} caracteres.</small>

                <div class="invalid-feedback" 
                    v-for="(error, x) in errors.PhoneContact" :key="x" :value="error">
                    {{ error }}
                </div>
                
                <div class="invalid-feedback" v-if="!$v.tel.required">El campo es obligatorio.</div>
                <div class="invalid-feedback" v-if="!$v.tel.numeric">El campo debe ser un número telefónico.</div>
                <div class="invalid-feedback" v-if="!$v.tel.maxLength">El campo no debe ser mayor a {{$v.tel.$params.maxLength.max}} caracteres.</div>
           </div>
            
            <div class="form-group col-md-6">
                <label for="References" class="col-form-label">Referencias *</label>
                <input 
                    type="text" 
                    class="form-control" 
                    :class="{ 'is-invalid': $v.references.$error || errors.References }" 
                    @input="setReferences($event.target.value)" 
                    v-model.trim="references"
                    name="References" 
                    id="References" maxlength="100" required>
                <small>Ej. Edificio azul</small>

                <div class="invalid-feedback" 
                    v-for="(error, x) in errors.References" :key="x" :value="error">
                    {{ error }}
                </div>
                
                <div class="invalid-feedback" v-if="!$v.references.required">El campo es obligatorio.</div>
                <div class="invalid-feedback" v-if="!$v.references.maxLength">El campo no debe ser mayor a {{$v.references.$params.maxLength.max}} caracteres.</div>   
            </div>
        </div>
    </div>
</template>

<script>
import { validationMixin } from 'vuelidate';
import { required, maxLength, maxValue, numeric } from 'vuelidate/lib/validators'

export default {
    mixins: [validationMixin],
    props:{
        states: {
            type: Object,
            required: true
        },
        errors: {
            type: Object,
            required: false
        },
        old: {
            type: Object,
            required: false
        },
        phone: {
            type: String,
            required: false
        },
        address: {
            type: Object,
            required: false
        }
    },
    data() {
        return {
            alias: 
                this.old.Alias ? 
                this.old.Alias : 
                (this.address ? this.address.Alias : ''),
            street: 
                this.old.Street ? 
                this.old.Street : 
                (this.address ? this.address.Street : ''),
            ext: 
                this.old.Ext ? 
                this.old.Ext : 
                (this.address ? this.address.Ext : ''),
            int: 
                this.old.Int ? 
                this.old.Int : 
                (this.address ? this.address.Int : ''),
            suburb: 
                this.old.Suburb ? 
                this.old.Suburb : 
                (this.address ? this.address.Suburb : ''),
            zipcode: 
                this.old.ZipCode ? 
                this.old.ZipCode : 
                (this.address ? this.address.ZipCode : ''),
            state: 
                this.old.State ? 
                this.old.State : 
                (this.address ? this.address.State : ''),
            city: 
                this.old.City ? 
                this.old.City : 
                (this.address ? this.address.City : ''),
            references: 
                this.old.References ? 
                this.old.References : 
                (this.address ? this.address.References : ''),
            tel: 
                this.old.PhoneContact ? 
                this.old.PhoneContact : 
                (this.address ? this.address.PhoneContact : ''),
        };
    },
    validations: {
        alias: {
            required,
            maxLength: maxLength(50)
        },
        street: {
            required,
            maxLength: maxLength(50)
        },
        ext: {
            required,
            maxLength: maxLength(50)
        },
        int: {
            maxLength: maxLength(50),
        },
        suburb: {
            required,
            maxLength: maxLength(50),
        },
        zipcode: {
            required,
            numeric,
            maxLength: maxLength(5),
        },
        state: {
            required,
            maxLength: maxLength(50),
        },
        city: {
            required,
            maxLength: maxLength(50),
        },
        tel: {
            required,
            numeric,
            maxLength: maxLength(10),
        },
        references: {
            required,
            maxLength: maxLength(100)
        }
    },
    methods : {
        setAlias(value){
            this.alias = value
            this.$v.alias.$touch()
        },
        setStreet(value){
            this.street = value
            this.$v.street.$touch()
        },
        setExt(value) {
            this.ext = value
            this.$v.ext.$touch()
        },
        setInt(value) {
            this.int = value
            this.$v.int.$touch()
        },
        setSuburb(value) {
            this.suburb = value
            this.$v.suburb.$touch()
        },
        setZipcode(value) {
            this.zipcode = value
            this.$v.zipcode.$touch()
        },
        setState(value) {
            this.state = value
            this.$v.state.$touch()
        },
        setCity(value) {
            this.city = value
            this.$v.city.$touch()
        },
        setTel(value) {
            this.tel = value
            this.$v.tel.$touch()
        },
        setReferences(value) {
            this.references = value
            this.$v.references.$touch()
        },
        count(number, el){
            return number - el;
        },
        touch () {
            this.$v.$touch()
        }
    }, mounted() {
        console.log(this.address);
    }
};
</script>