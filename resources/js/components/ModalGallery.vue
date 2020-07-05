<template>
    <div class="modal fade bd-example-modal-lg js-gallery-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div :id="'carouselExampleControls'" class="carousel" data-ride="carousel"  data-interval="false">
                        <div class="carousel-inner">
                            <div :class="'carousel-item '+(current === img.ReturnImgID ? 'active' : '')" v-for="img in images" :key="img.ReturnImgID" >
                                <img class="d-block w-100" :src="path+'/storage/'+img.ReturnUrl" >
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                images: {},
                current: '',
                path: ''
            };
        },
        mounted() {

            this.path = this.$root.path;

            this.$root.$on('gallery-images', data => {
                this.images = data;
            })

            this.$root.$on('current-image', data => {
                this.current = data;
            })

            console.log(this.current);
        }
    };
</script>
