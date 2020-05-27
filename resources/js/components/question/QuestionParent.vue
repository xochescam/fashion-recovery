<template>
    <div>
        <div class="mb-4 question-parent" 
            v-for="current in questions" 
            :key="current.id" 
            :value="current.id" >
            <p class="border-left pl-3">
                {{ current.Question }}<br>
                <small>Por
                    <a 
                        class="green-link" 
                        :href="url+'/user/'+current.Alias"
                        v-if="current.ProfileID === 2">
                        {{ current.Name }}
                    </a>
                    <span v-else> 
                        {{ current.Name }} 
                    </span>
                    el {{ current.date }} 
                </small>
            </p>

            <question-son 
                :question="current"
                v-if="current.answers.length > 0">
            </question-son>
        </div>
                
        <div class="mb-4 question-parent" v-if="!questions > 0">
            <p class="border-left pl-3">
                {{ question.Question }}<br>
                <small>Por
                    <a 
                        class="green-link" 
                        :href="url+'/user/'+question.Alias"
                        v-if="question.ProfileID === 2">
                        {{ question.Name }}
                    </a>
                    <span v-else> 
                        {{ question.Name }} 
                    </span>
                    el {{ question.date }} 
                </small>
            </p>

            <question-son 
                :question="question"
                v-if="question.answers.length > 0">
            </question-son>

        </div>
    </div>
</template>
<script>
    export default {
        props: {
            questions: {
                type: Array,
                required: false
            },
            question: {
                type: Object,
                required: false
            },
        },
        data() {
            return {
                url: this.$root.path
            }
        }
    };
</script>