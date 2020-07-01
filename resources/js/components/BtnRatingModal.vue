<template>
   <button type="button" class="btn btn-fr btn-sm d-block float-lg-right d-block d-lg-inline mt-2 mt-lg-0" data-toggle="modal" @click="openModal()">
		{{ text }}
	</button>
</template>

<script>
    export default {
        props:{
            order: {
                type: String,
            },
            order: {
                type: String,
            },
            text: {
                type: String,
            },
        },
        methods : {
            openModal() {

                if(this.text == "Evalua tu experiencia") {
                    const form = document.querySelector('.js-rating-form');
                    form.action = this.$root.path+'/survey/'+this.order;

                    $(".js-rating-modal").modal({
                        backdrop: "static",
                        keyboard: false,
                        show: true
                    });

                } else {

                    $(".js-results-rating-modal").modal({
                        backdrop: "static",
                        keyboard: false,
                        show: true
                    });
                }

            }
        },
        mounted() {            
        }
    };
</script>
