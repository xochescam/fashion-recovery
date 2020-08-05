<template>
    <div class="form-group">
        <label for="exampleFormControlSelect2"> {{ type === 'return' ? 'Agrega una imagen *' : 'Subir evidencia *' }} </label>
        <div class="custom-file">
        <input type="file" class="custom-file-input" ref="Photos"  name="Photos[]" id="Photos" :accept="type === 'return' ? 'image/jpeg,image/gif,image/png' : 'image/jpeg,image/gif,image/png,application/pdf'" @change="change($event.currentTarget.files)" required>
        <label class="custom-file-label" for="Photos">Seleccionar archivo</label>

        <ul class="list-pictures">
            <li v-for="file in files" :key="file.name">{{ file.name }}</li>
        </ul>
        <div class="invalid-validation" v-for="error in errors.Photos" :key="error.name">
            {{ error }}
        </div>

        <div class="invalid-validation" v-if="count">
            No puedes agregar más de tres imagenes.
        </div>
        </div>
    </div>

</template>

<script>
    export default {

        props: {
            errors: {
                type: Object,
                required: false
            },
            type: {
                type: String,
            },
        },
        data() {
            return {
                files: [],
                count: false
            };
        },
        methods: {
            change(files) {
                if(files.length > 3) {
                    this.count = true;  
                    this.$refs.Photos.value = "";
                    this.files = [];
                } else {
                    this.files = files;
                    this.count = false; 
                }
            }
        }
    };
</script>
