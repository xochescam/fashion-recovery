<template>
    <a 
        data-toggle="modal" 
        data-target="#transferModal"
        class="btn btn-info btn-sm" 
        role="button"
        @click="openModal">
            Transferir
    </a>
</template>

<script>
    export default {
        props: {
            data: {
                type: String,
                required: false
            },
        },
        data() {
            return {
                url: this.data
            };
        },
        methods: {
            openModal() {
                document.querySelector('.transfer-form').action = this.$root.path + this.data;
            }
        },
    };
</script>
