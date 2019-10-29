<template>
    <div class="d-flex align-top">
        <input 
        class="switch-checkbox" 
        type="checkbox"  
        id="IsPaused" 
        name="IsPaused" 
        value="true"  
        @click="changeStatus()"/>
        <label for="IsPaused" class="switch-label"></label>
    </div>
</template>

<script>
    export default {

        props: {

            /**
             * Receive an initial selected value.
             */
            initial: {
                type: String,
                required: false,
                default: ''
            }
        },
        methods: {
            changeStatus() {

                const el = document.getElementById('IsPaused');
                const IsPaused = el.checked;

                window.axios
                    .get('update/guardarropa/'+IsPaused)
                    .then(response => {

                        console.log(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                    })
            }
        },
        mounted() {

            if(this.initial ) {

                const el = document.getElementById('IsPaused');
                el.setAttribute('checked',true);

            }
        }
    };
</script>
