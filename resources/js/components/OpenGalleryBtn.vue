<template>
    <button class="media-thumb" @click="openModal(image.ReturnImgID)">
        <img :src="this.$root.path+'/storage/'+image.ReturnThumb">
    </button>
</template>

<script>
    export default {

        props: {
            all: {
                type: Array,
            },
            image: {
                type: Object,
            },
        },
        data() {
            return {
                img: this.image,
                count: false
            };
        },
        methods: {
            openModal(ReturnImgID) {
                this.$root.$emit('gallery-images', this.all);
                this.$root.$emit('current-image', ReturnImgID);

                $(".js-gallery-modal").modal({
                    backdrop: "static",
                    keyboard: false,
                    show: true
                });
            }
        },
        mounted() {

            console.log(this.image);
        }
    };
</script>
