<template>
        <div class="row">
          <h2 class="text-center TituloFR my-4 mb-5 w-100"> {{ type == 'answer' ? 'Contestar pregunta' : 'Tienes una pregunta' }}</h2>

          <div class="w-100">

            <div class="card m-auto card-thumb">
              <img :src="this.$root.path+'/storage/'+thumb" >
            </div>
          </div>
          
          <div class="col-md-8 offset-md-2 mt-5">
            <form 
              method="POST" 
              :action="this.$root.path+'/question/'+type" 
              class="needs-validation" 
              novalidate
              ref="form"
              v-on:submit.prevent="create">

              <div class="alert alert-warning alert-dismissible mb-5 fade show" role="alert" v-if="wrgmessage">
                {{ wrgmessage }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="wrgmessage = ''">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

              <question-parent
                :questions="questions"
                :question="current"
              ></question-parent>

              <div class="form-group">
                <label for="answer"> {{ type == 'answer' ? 'Contestar pregunta' : '¿Tienes una pregunta?' }} </label>
                <textarea class="form-control" name="answer" id="answer" rows="2" ref="answer" required></textarea>

                <div class="invalid-validation" v-if="errors.answer">
                    {{ errors.answer }}
                </div>
                <div class="invalid-feedback" v-else>
                    Ingresa una respuesta.
                </div>
            </div>

              <div class="text-center mt-5">
                <button type="submit" class="btn btn-fr"
                :disabled="saving">
                  <span 
                    class="spinner-border spinner-border-sm" 
                    :class="saving ? 'spinner-border-block' : 'hidden'" 
                    role="status" 
                    aria-hidden="true"></span>
                  {{ type == 'answer' ? 'Contestar' : 'Preguntar' }}
               </button>
              </div>
            </form>
          </div>
        </div>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                required: false
            },
            errors: {
                type: [Object, Array],
                required: false
            },
            question: {
                type: Object,
                required: false
            },
            questions: {
                type: Object,
                required: false
            },
            warning: {
                type: String,
                required: false 
            },
            thumb: {
                type: String,
                required: false 
            }
        },
        data() {
            return {
              saving: false,
              wrgmessage : this.warning, 
              current: this.question
            }
        },
        methods: {
          create() {

            if(this.$refs.answer.value === "") {
              return;
            }

            this.saving = true;

            const formData = new FormData();
            formData.append('answer', this.$refs.answer.value);
            formData.append('questionUser', this.question.UserID);
            formData.append('ItemID', this.question.ItemID);
            formData.append('QuestionID', this.question.QuestionID); 
            formData.append('ParentID',  this.question.IsParent ? this.question.ItemID : this.question.ParentID); 

            axios
              .post(this.$root.path+'/question/'+this.type, formData)
              .then(response => {

                if(response.status == 200 || response.status == 201) {

                  this.current.answers.push(response.data);

                  if(this.current.answers.length > 1) {
                    this.current.filterAnsw.push(response.data);
                  }

                  console.log(this.current);

                  this.reset();
                }
                
              })
              .catch(error => {
                console.log(error);
            })
          },
          reset() {
            this.$refs.form.classList.remove('was-validated');
            this.$refs.answer.value = '';
            this.saving = false;
          }
        }
    };
</script>