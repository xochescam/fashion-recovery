<template>
    <div>
        <ul class="progressbar">
			<li :class="current > 0 ? 'active' : ''">Carrito</li>
			<li :class="current > 1 ? 'active' : ''">Dirección</li>
			<li :class="current > 2 ? 'active' : ''">Pago</li>
			<li :class="current > 3 ? 'active' : ''">Confirmación</li>
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
        },
        data() {
            return {
                current: 0
            };
        },
        methods: {
            init() {
            },
        },
        mounted() {
            this.current = JSON.parse(this.step);

            console.log(JSON.parse(this.step));
        }
    };
</script>
