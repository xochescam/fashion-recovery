<template>
    <li class="nav-item dropdown order-2 order-sm-1">
        <a class="nav-link dropdown-toggle float-left float-sm-none text-left dropdown-option pl-2 pl-sm-0 pr-sm-3" 
        data-toggle="dropdown" href="#" role="button" 
        aria-haspopup="true" aria-expanded="false">

            <i class="fas fa-bell" v-if="all.length > 0"></i>
            <span class="badge badge-pill badge-light badge-notifications" v-if="all.length > 0">
                {{ all.length  }}
            </span>

            <i class="fas fa-bell" v-else></i>

            <span class="ml-1 d-inline-block d-sm-none">Notificaciones</span>
        </a>
        <div class="dropdown-menu text-white dropdown-menu--notifications mt-sm-3 p-0">

                <a 
                    class="dropdown-item text-left px-3 py-2 bg-light" 
                    v-for="notification in all" 
                    :key="notification.NotificationID" 
                    :value="notification.NotificationID"
                    :href="getHref(notification)">
                    <i class="far fa-user pr-1"></i>

                    <span>{{ getText(notification)  }}</span>

                </a>
                
                <div class="dropdown-divider m-0" v-if="all.length > 1"></div>

                <a 
                    class="check-all d-block text-secondary text-center px-3 py-2 cursor-pointer" 
                    v-if="all.length > 0"
                    @click="deleteAll">
                    Marcar todas como leídas
                </a>

            <a href="#" class="dropdown-item text-left" v-if="all.length === 0">
                No tienes notificaciones
            </a>
        </div>
    </li>
</template>

<script>

export default {
    props: {
        notifications: Array
    },
    data() {
        return {
            all: this.notifications
        }
    },
    mounted() {
        //console.log(this.all);
    },
    methods: {
        deleteAll() {

            axios
                .post(this.$root.path+'/notification-delete')
                .then(response => {

                    if(response.data == 'success') {
                        this.all = [];
                    }
                })
                .catch(error => {
                    console.log(error);
            })
        },
        getHref(notification) {

            const hrefs = {
                'follower' : '/followers',
                'question' : '/question/'+notification.TableID+'/answer',
                'answer' : 'question/'+notification.TableID+'/question'
            };

            return hrefs[notification.Type];
        },
        getText(notification) {

            const texts = {
                'follower' : 'Tienes un nuevo seguidor.',
                'question' : 'Tienes una nueva pregunta.',
                'answer' : 'Tienes respuestas por leer.'
            };

            return texts[notification.Type];
        }

    }
};
</script>