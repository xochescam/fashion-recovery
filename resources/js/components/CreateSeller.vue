<template>
    <div>
        <div class="form-row">
            <div class="form-group col-md-6 mb-5 js-items-container text-center">
                <label>Foto de perfil *</label>

                <div class="thumb-size js-item-picture mx-auto">
                    <input 
                        type="file" 
                        name="profile_item_file" 
                        id="profile_item_file" 
                        class="no-file js-item-file custom-file-input" 
                        :class="{ 'is-invalid': errors.profile_item_file }"
                        data-type="Foto de perfil" 
                        data-name="profile" 
                        data-item="false" 
                        accept=".png, .jpg, .jpeg" 
                        required>
                    <label for="profile_item_file" class="card card--file-item custom-file-label m-auto" >
                    <span><i class="far fa-image"></i> <br>Foto de perfil</span>
                    </label>
                    <div class="container-item-img m-auto"></div>

                    <div class="invalid-feedback" 
                        v-for="(error, x) in errors.profile_item_file" :key="x" :value="error">
                        {{ error }}
                    </div>

                    <div class="invalid-feedback">
                        El campo es obligatorio.
                    </div>
                </div>
            </div>

            <div class="form-group col-md-6 mb-5 js-items-container text-center">
                <label>Documento de identificación *</label>

                <div class="thumb-size js-item-picture mx-auto">
                    <input 
                        type="file" 
                        name="id_item_file" 
                        id="id_item_file" 
                        class="no-file js-item-file custom-file-input" 
                        :class="{ 'is-invalid': errors.id_item_file }"
                        data-type="Documento de identificación" 
                        data-name="id" 
                        data-item="false" 
                        accept=".png, .jpg, .jpeg" 
                        required>
                    <label for="id_item_file" class="card card--file-item custom-file-label m-auto">
                        <span><i class="far fa-image"></i> <br>Documento de identificación</span>
                    </label>
                    <div class="container-item-img m-auto"></div>

                    <small>Foto de tu INE o Pasaporte</small>

                    <div class="invalid-feedback" 
                        v-for="(error, x) in errors.id_item_file" :key="x" :value="error">
                        {{ error }}
                    </div>

                    <div class="invalid-feedback">
                        El campo es obligatorio.
                    </div>
                </div>
            </div>
        </div>

        <div class="form-row" :class="{ 'mt-5': errors.id_item_file || errors.profile_item_file}">
            <div class="form-group col-md-6">
                <label for="Greeting">Deja un saludo *</label>
                <textarea 
                    name="Greeting" 
                    id="Greeting" 
                    v-model.trim="greeting" 
                    class="form-control" 
                    :class="{ 'is-invalid': $v.greeting.$error || errors.Greeting }"
                    @input="setGreeting($event.target.value)"
                    placeholder="Deja un saludo para que tú perfil sea confiable y amigable a tus posibles clientes" 
                    rows="3" maxlength="50" required> </textarea>
                <small>{{ count(50, $v.greeting.$model.length) }} caracteres.</small>

                <div class="invalid-feedback" 
                    v-for="(error, x) in errors.Greeting" :key="x" :value="error">
                    {{ error }}
                </div>

                <div class="invalid-feedback" v-if="!$v.greeting.required">El campo es obligatorio.</div>
                <div class="invalid-feedback" v-if="!$v.greeting.maxLength"> El campo no debe ser mayor a {{$v.greeting.$params.maxLength.max}} caracteres.</div>
            </div>

            <div class="form-group col-md-6">
                <label for="AboutMe">Acerca de mi *</label>
                <textarea 
                    name="AboutMe" 
                    id="AboutMe" 
                    v-model.trim="aboutme" 
                    class="form-control" 
                    :class="{ 'is-invalid': $v.aboutme.$error || errors.AboutMe }"
                    @input="setAboutMe($event.target.value)"
                    placeholder="Escribe una breve descripción sobre ti; por ejemplo: ¿Por qué decidiste vender en Fashion Recovery?" 
                    rows="3" maxlength="256" required></textarea>
                <small>{{ count(256, $v.aboutme.$model.length) }} caracteres.</small>

                <div class="invalid-feedback" 
                    v-for="(error, x) in errors.AboutMe" :key="x" :value="error">
                    {{ error }}
                </div>

                <div class="invalid-feedback" v-if="!$v.aboutme.required">El campo es obligatorio.</div>
                <div class="invalid-feedback" v-if="!$v.aboutme.maxLength"> El campo no debe ser mayor a {{$v.aboutme.$params.maxLength.max}} caracteres.</div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="Phone">Teléfono *</label>
                <input 
                    type="tel" 
                    name="Phone" 
                    id="Phone" 
                    v-model.trim="phone" 
                    class="form-control" 
                    :class="{ 'is-invalid': $v.phone.$error || errors.Phone }"
                    @input="setPhone($event.target.value)"
                    placeholder="5212000000" 
                    required 
                    maxlength="10"
                    ref="phone">
                <small>{{ count(10, $v.phone.$model.length) }} caracteres.</small>

                <div class="invalid-feedback" 
                    v-for="(error, x) in errors.Phone" :key="x" :value="error">
                    {{ error }}
                </div>

                <div class="invalid-feedback" v-if="!$v.phone.required">El campo es obligatorio.</div>
                <div class="invalid-feedback" v-if="!$v.phone.numeric">El campo debe ser un número telefónico.</div>
                <div class="invalid-feedback" v-if="!$v.phone.maxLength"> El campo no debe ser mayor a {{$v.phone.$params.maxLength.max}} caracteres.</div>
             </div>
            <div class="form-group col-md-6">
                <label for="LiveIn">Lugar de residencia *</label>
                <select 
                    name="LiveIn" 
                    id="LiveIn" 
                    v-model.trim="livein" 
                    class="form-control"
                    :class="{ 'is-invalid': $v.livein.$error || errors.LiveIn }" 
                    @input="setLiveIn($event.target.value)"
                    required>
                    <option value="" selected>- Seleccionar -</option>
                    <option v-for="(state, x) in states" 
                        :key="x" :value="state"
                        :selected="old.LiveIn == state">
                        {{ state }}</option> 
                </select>
                <small>Lorem ipsum dolor sit amet, consectetur adipisicing.</small>

                <div class="invalid-feedback" 
                    v-for="(error, x) in errors.LiveIn" :key="x" :value="error">
                    {{ error }}
                </div>

                <div class="invalid-feedback" v-if="!$v.livein.required">El campo es obligatorio.</div>
            </div>
        </div>

        <h4 class="text-left TituloFR my-4 mb-5">Datos de dirección</h4>

        <address-form
            :states="states"
            :errors="errors"
            :old="old"
            :phone="phone"
        >
        </address-form>

        <div class="text-center mt-5">
            <button type="submit" class="btn btn-fr w-50">
                <span class="spinner-border spinner-border-sm hidden" ref="spin" role="status" aria-hidden="true"></span>
                Comenzar a vender
            </button>
        </div>  
    </div>
</template>

<script>
import { validationMixin } from 'vuelidate';
import { required, maxLength, maxValue, numeric } from 'vuelidate/lib/validators'
import AddressForm from './AddressForm'

export default {
    mixins: [ validationMixin ],
    components: {AddressForm},
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
        }
    },
    data() {
        return {
            greeting : this.old.Greeting ? this.old.Greeting : '',
            aboutme : this.old.AboutMe ? this.old.AboutMe : '',
            phone : this.old.Phone ? this.old.Phone : '',
            livein: this.old.LiveIn ? this.old.LiveIn : ''
        };
    },
    validations: {
        greeting: {
            required,
            maxLength: maxLength(50)
        },
        aboutme: {
            required,
            maxLength: maxLength(256)
        },
        phone: {
            required,
            numeric,
            maxLength: maxLength(10),
        },
        livein: {
            required,
        }
    },
    methods : {
        setGreeting(value){
            this.greeting = value
            this.$v.greeting.$touch()
        },
        setAboutMe(value){
            this.aboutme = value
            this.$v.aboutme.$touch()
        },
        setPhone(value) {
            this.phone = value
            this.$v.phone.$touch()
            //document.querySelector('#PhoneContact').value = value;
        },
        setLiveIn(value) {
            this.livein = value
            this.$v.livein.$touch()
        },
        count(number, el){
            return number - el;
        },
        submit() {
            this.$v.$touch()
            this.$children[0].$v.$touch()
            
            if(this.$v.$invalid && this.$children[0].$v.$invalid) {
                return false;
            } else {
                return true;
            }

            const data = {
                "greeting" : this.greeting,
                "aboutme": this.aboutme,
                "phone": this.phone,
                "livein": this.livein,
                "alias": this.$children[0].alias,
                "street": this.$children[0].street,
                "ext": this.$children[0].ext,
                "int": this.$children[0].int,
                "suburb": this.$children[0].suburb,
                "zipcode": this.$children[0].zipcode,
                "state": this.$children[0].state,
                "city": this.$children[0].city,
                "tel": this.$children[0].tel,
                "references": this.$children[0].references
            };


            window.axios
                .post(window.location.origin+'/seller/',{
                    content: data
                })
                .then(response => {

                    console.log(response)

                })
                .catch(error => {
                    console.log(error)
                })

        }
    }
};
</script>