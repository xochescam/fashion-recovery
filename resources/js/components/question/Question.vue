<template>
    <div class="col-sm-8 col-12 mt-5">
		<h5>Preguntas y respuestas</h5>

        <form 
            method="POST" 
            :action="this.$root.path+'/question'" 
            class="needs-validation my-5" 
            ref="form"
            novalidate
            v-on:submit.prevent="create">

            <div class="alert alert-warning alert-dismissible mb-5 fade show" role="alert" v-if="warning">
                {{ warning }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="warning = ''">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

			<div class="form-group">
				<label for="question">¿Tienes una pregunta?</label>
				<textarea class="form-control" name="question" id="question" ref="question" rows="2" required></textarea>

			    <div class="invalid-validation" v-if="errors.question">
			        {{ errors.question }}
			    </div>
			    <div class="invalid-feedback" v-else>
			        Ingresa una pregunta.
		        </div>
			</div>
			<div>
                <button type="submit" class="btn btn-fr w-25"
                :disabled="saving">
                  <span 
                    class="spinner-border spinner-border-sm" 
                    :class="saving ? 'spinner-border-block' : 'hidden'" 
                    role="status" 
                    ref="spin"
                    :aria-hidden="saving"></span>
                    Preguntar
               </button>
              </div>
		</form>

		<question-parent
			:questions="all"
			:question="{}"
	    ></question-parent>

	</div>
</template>

<script>
    export default {
        props: {
            errors: {
                type: Array,
                required: false
            },
            questions: {
                type: Object,
                required: false
            },
            item: {
                type: Number,
                required: false
            },
            auth: {
                type: Boolean,
                required: false,
            }
        },
        data() {
            return {
              saving: false,
              all : Object.values(this.questions),
              warning: ''
            }
        },
        methods: {
          create() {

            if(!this.auth) {
                window.location.href = this.$root.path + '/login/0'
            }

            if(this.$refs.question.value === "") {
              return;
            }

            this.saving = true;

            const formData = new FormData();
            formData.append('question', this.$refs.question.value);
            formData.append('ItemID', this.item);



            axios
              .post(this.$root.path+'/question', formData)
              .then(response => {

                if(response.status == 200 || response.status == 201) {

                    if(response.data.status == 205) {
                        this.warning = response.data.message;
                        this.reset();

                    } else {

                        this.all.push(response.data);
                        this.reset();
                    }
                }

                console.log(response.data);
                console.log(this.all);

              })
              .catch(error => {
                console.log(error);
            })
          },
          reset() {
            this.saving = false;
            this.$refs.form.classList.remove('was-validated');
            this.$refs.question.value = '';
            this.$refs.spin.removeAttribute('style');
            
          }
        }
    };
</script>