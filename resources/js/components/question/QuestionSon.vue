<template>
    <div>
        <div class="mt-3 ml-5 question-son">
            <div class="mr-5">
                <p>
                    {{ current.answers[0].Question }}<br>
                    <small >
                        Por 
                        <a 
                            class="green-link" 
                            :href="this.$root.path+'/seller/'+current.answers[0].Alias"
                            v-if="current.answers[0].ProfileID === 2">
                            {{ current.answers[0].Name }}</a>
                        <span v-else>
                            {{ current.answers[0].Name }}
                        </span>
                        el {{ current.answers[0].date }}
                    </small>

                    <small v-if="current.answers.length > 1">
                        <a href="#collapseExample"  data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample" class="green-link"><br>
                            <i class="fas fa-chevron-down"></i>
                            <b>Ver más ({{ current.answers.length - 1 }})</b>
                        </a>
                    </small>
                </p>
            </div>
        </div>

        <div class="collapse" id="collapseExample" v-if="current.answers.length > 1">
            <div class="ml-5"
                v-for="asnwer in current.filterAnsw" 
                :key="asnwer.id" 
                value="current.id">
                <div class="mr-5">
                    <p>
                        {{ asnwer.Question }}<br>
                        <small>Por
                            <a 
                                class="green-link" 
                                :href="'/seller/'+asnwer.Alias"
                                v-if="asnwer.ProfileID === 2">
                                {{ asnwer.Name }}
                            </a>
                            <span v-else> 
                                {{ asnwer.Name }} 
                            </span>
                            el {{ asnwer.date }} 
                        </small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            question: {
                type: Object,
                required: false
            }
        },
        data() {
            return {
                current: this.question
            }
        }
    };
</script>