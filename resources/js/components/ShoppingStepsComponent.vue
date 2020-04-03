<template>
    <div>
        <ul class="progressbar">
			<li :class="current > 0 ? 'active' : ''"> 
                <a :href="urlone ? urlone : '#'">1</a> 
                Carrito
            </li>
			<li :class="current > 1 ? 'active' : ''"> 
                <a :href="urlone ? urlone : '#'">2</a> 
                Dirección
            </li>
			<li :class="current > 2 ? 'active' : ''"> 
                <a :href="urlthree ? urlthree : '#'">3</a> 
                Pago
            </li>
			<li :class="current > 3 ? 'active' : ''"> 
                <a :href="urlfour ? urlfour : '#'">4</a> Confirmación
            </li>
		</ul>
    </div>

</template>

<script>
    export default {

        props: {
            /**
             * The select field change its options depending
             * on the received value.
             */
            step: {
                type: String,
                required: false
            },
            urlone: {
                type: String,
                required: false
            },
            urltwo: {
                type: String,
                required: false
            },
            urlthree: {
                type: String,
                required: false
            },
            urlfour: {
                type: String,
                required: false
            },
        },
        data() {
            return {
                current: 0
            };
        },
        methods: {

        },
        mounted() {            
            this.current = JSON.parse(this.step);
        }
    };
</script>
