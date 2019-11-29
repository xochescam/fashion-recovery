<template>
    <div class="d-flex align-top">
        <input 
        class="switch-checkbox" 
        type="checkbox"  
        :id="('IsPaused'+this.item)" 
        :name="('IsPaused'+this.item)"
        :value="(this.item)"  
        @click="changeStatus()"/>
        <label :for="('IsPaused'+this.item)" class="switch-label m-0"></label>
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
            },
            type: {
                type: String,
                required: false,
                default: ''
            },
            item: {
                type: String,
                required: false,
                default: ''
            },
        },
        methods: {
            changeStatus() {

                const el = document.getElementById('IsPaused'+this.item);
                const IsPaused = el.checked;

                console.log(this.item);

                window.axios
                    .get('update/'+this.type+'/'+IsPaused+'/'+this.item)
                    .then(response => {

                        console.log(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                    })
            }
        },
        mounted() {

            //console.log(this.item);
            

            if(this.initial) {
                const el = document.getElementById('IsPaused'+this.item);
                el.setAttribute('checked',true);
            }
        }
    };
</script>
