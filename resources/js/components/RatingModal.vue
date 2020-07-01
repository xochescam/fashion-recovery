<template>
    <div class="modal fade js-rating-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Evalua tu experiencia"</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="POST" :url="this.$root.path+'/survey'">

                        <input type="hidden" name="Order" class="js-order" v-if="false">

                        <div v-for="question in questions" :key="question.Slug">
                            <div class="form-group mb-4" v-if="!question.IsText">
                                <label class="font-weight-light">¿Qué calificación le das a tu compra?</label>
                                <div class="rate">
                                    <input type="radio" :id="question.Slug+'-5'" :name="question.Slug" value="5" class="rate__input"/>
                                    <label :for="question.Slug+'-5'"  class="rate__star">
                                        <i class="fas fa-star"></i> 
                                    </label>
                                    <input type="radio" :id="question.Slug+'-4'" :name="question.Slug" value="4" class="rate__input"/>
                                    <label :for="question.Slug+'-4'"  class="rate__star">
                                        <i class="fas fa-star"></i> 
                                    </label>
                                    <input type="radio" :id="question.Slug+'-3'" :name="question.Slug" value="3" class="rate__input"/>
                                    <label :for="question.Slug+'-3'"  class="rate__star">
                                        <i class="fas fa-star"></i> 
                                    </label>
                                    <input type="radio" :id="question.Slug+'-2'" :name="question.Slug" value="2" class="rate__input"/>
                                    <label :for="question.Slug+'-2'"  class="rate__star">
                                        <i class="fas fa-star"></i> 
                                    </label>
                                    <input type="radio" :id="question.Slug+'-1'" :name="question.Slug" value="1" class="rate__input"/>
                                    <label :for="question.Slug+'-1'" class="rate__star">
                                        <i class="fas fa-star"></i> 
                                    </label>
                                </div>
                            </div>
                            <div class="form-group" v-if="question.IsText" >
                                <label :for="question.Slug">¿Tienes algún comentario?</label>
                                <textarea class="form-control" :id="question.Slug" :name="question.Slug" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="text-center mt-5 mb-2">
                            <button type="button" class="btn btn-secondary m-auto" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-fr m-auto">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



</template>

<script>
    export default {
        props:{
            questions: {
                type: Array,
                required: true
            },
        },
        data() {
            return {
                order: ''
            };
        },
        watch: {
            order: function (val) {
                this.$root.$on('OrderID', data => {
                    this.order = data;
                });
            },
        },
        mounted() {            
        
        }
    };
</script>
