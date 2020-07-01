<template>
    <div class="form-group">
        <label for="exampleFormControlSelect2">Fotos de la prenda</label>
        <div class="custom-file">
        <input type="file" class="custom-file-input" name="Photos[]" id="Photos" accept=".png, .jpg, .jpeg" multiple @change="change($event.currentTarget.files)">
        <label class="custom-file-label" for="Photos">Seleccionar archivo</label>

        <ul class="list-pictures">
            <li v-for="file in files" :key="file.name">{{ file.name }}</li>
        </ul>
        <div class="invalid-validation" v-for="error in errors.Photos" :key="error.name">
            {{ error }}
        </div>
        </div>
    </div>

</template>

<script>
    export default {

        props: {
            errors: {
                type: Object,
            },
        },
        data() {
            return {
                files: []
            };
        },
        methods: {

            change(files) {
                this.files = files;
                
            }
        },
        mounted() {
            console.log(this.errors.Photos);
        }
    };
</script>
