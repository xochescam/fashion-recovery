<template>
    <select 
        :id="id" 
        :name="name"
        class="form-control"
        :value="value"
        @input="$emit('input', $event.target.value)"
        v-on:change="changeDepartment($event.target.value)"
    >
        <option :value="value">- Seleccionar -</option>

        <option v-for="option in filteredOptions"
            :key="option.value"
            :value="option.value"
            v-text="option.option">
        </option>
    </select>

</template>

<script>
    export default {

        props: {
            /**
             * The select field change its options depending
             * on the received value.
             */
            dynamic: {
                type: String,
                required: false
            },

            /**
             * Receive an initial selected value.
             */
            initial: {
                type: String,
                required: false,
                default: ''
            },


            /**
             * An object of values and descriptions to populate the options
             * inside the select field.
             */
            options: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                DepartmentID: ''
            };
        },
        methods: {
            init() {

                if(this.initial) {
                    this.$root.$emit('DepartmentID', this.initial); 
                }
            },
            changeDepartment(el) {
                this.$root.$emit('DepartmentID', el);                
            }
        },
        computed: {
            filteredOptions: function() {
                if (this.dynamic === undefined) {
                    return this.options;
                };

                

                return this.options[this.dynamic];
            }
        },
        mounted() {
            this.init();
            $("#DepartmentID").val(this.initial);
        }
    };
</script>
