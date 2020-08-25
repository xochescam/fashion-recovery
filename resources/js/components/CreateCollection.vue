

<template>
    <div>
        <select id="ClosetID" class="form-control" name="ClosetID" @change="change($event.target.value)" v-show="!isnew">
            <option value="" selected>- Seleccionar -</option>
            <option value="default" v-if="closets.length == 0"> Colección por defecto </option>

            <option 
                v-for="closet in closets" 
                :key="closet.ClosetID" 
                :value="closet.ClosetID" 
                :selected="(item && item.ClosetID == closet.ClosetID) || (old && old.ClosetID == closet.ClosetID)"> 
                {{ closet.ClosetName }}
            </option> 

            <option value="crear"> Nueva colección </option>       
        </select>

        <div :class=" isnew ? 'd-flex' : 'd-none' " >
            <input type="text" class="form-control" id="ClosetName" name="ClosetName" ref="ClosetName" >
            <button type="button" @click="isnew = false" class="btn"> <i class="fas fa-undo-alt"></i> </button>
        </div>

    </div>
</template>
<script>

export default {
    props:{
        closets: {
            type: Array,
            required: true
        },
        item: {
            type: [Array, Object],
            required: false
        },
        old: {
            type: String,
            required: false
        },
    },
    data() {
        return {
            all : this.closets,
            isnew : false

        };
    },
    methods : {

        change(val) {

            if(val == 'crear') {
                this.isnew = true;
            }
        }
    }
};
</script>