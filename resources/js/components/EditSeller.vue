<template>
    <div>
        <div v-if="edit">
            <div class="text-right">
                <button type="button" @click="edit = false" class="btn btn-outline-green">Cancelar</button>
            </div> 

            <div class="form-group">
                <label for="Greeting">Deja un saludo *</label>
                <textarea 
                    name="Greeting" 
                    id="Greeting" 
                    v-model.trim="greeting" 
                    class="form-control" 
                    :class="{ 'is-invalid': $v.greeting.$error || errors.Greeting }"
                    @input="setGreeting($event.target.value)"
                    placeholder="Deja un saludo para que tú perfil sea confiable y amigable a tus posibles clientes; por ejemplo: ¡Hola amantes de la naturaleza!" 
                    rows="3" maxlength="50" required> </textarea>
                <small>{{ count(50, $v.greeting.$model.length) }} caracteres.</small>

                <div class="invalid-feedback" 
                    v-for="(error, x) in errors.Greeting" :key="x" :value="error">
                    {{ error }}
                </div>

                <div class="invalid-feedback" v-if="!$v.greeting.required">El campo es obligatorio.</div>
                <div class="invalid-feedback" v-if="!$v.greeting.maxLength"> El campo no debe ser mayor a {{$v.greeting.$params.maxLength.max}} caracteres.</div>
            </div>

            <div class="form-group">
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

            <div class="form-group">
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
            <div class="form-group">
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

            <div class="text-center mt-5">
                <button type="submit" class="btn btn-fr w-50">
                    <span class="spinner-border spinner-border-sm hidden" ref="spin" role="status" aria-hidden="true"></span>
                    Guardar
                </button>
            </div>  
        </div>

        <div v-if="!edit">
            <div class="text-right">
                <button type="button" @click="edit = true" class="btn btn-outline-green">Editar</button>
            </div>  

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Saludo</label>
              <label class="col-sm-9 col-form-label text-left">{{ greeting }}</label>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Acerca de mi</label>
              <label class="col-sm-9 col-form-label text-left">{{ aboutme }}</label>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Teléfono</label>
              <label class="col-sm-9 col-form-label text-left">{{ phone }}</label>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Lugar de residencia</label>
              <label class="col-sm-9 col-form-label text-left">{{ livein }}</label>
            </div>

        </div>

    </div>
</template>

<script>
import { validationMixin } from 'vuelidate';
import { required, maxLength, maxValue, numeric } from 'vuelidate/lib/validators'

export default {
    mixins: [ validationMixin ],
    props:{
        seller: {
            type: Object,
            required: true
        },
        states: {
            type: Object,
            required: true
        },
        errors: {
            type: [Object, Array],
            required: false
        },
        old: {
            type: Object,
            required: false
        }
    },
    data() {
        return {
            greeting : this.old.Greeting ? this.old.Greeting : this.seller.Greeting,
            aboutme : this.old.AboutMe ? this.old.AboutMe : this.seller.AboutMe,
            phone : this.old.Phone ? this.old.Phone : this.seller.Phone,
            livein: this.old.LiveIn ? this.old.LiveIn : this.seller.LiveIn,
            edit: false
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