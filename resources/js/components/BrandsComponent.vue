<template>
  <div>
    <input type="text" class="form-control" autocomplete="off" name="BrandID" v-model="BrandID" v-on:keyup="searching=true" v-on:keyup.delete="filter()">
    <div class="position-relative" v-show="searching">
        <ul class="list-group position-absolute w-100 list-brands">
            <li 
            class="list-group-item list-group-item-action py-2"
            v-for="brand in filter()" 
            :key="brand.id" 
            :value="brand.id" 
            v-on:click="selectBrand(brand.name)">{{brand.name}}</li>
        </ul>
    </div>
  </div>
</template>

<script>
export default {
         props: {
            options: {
                type: Object,
                required: true
            }
        },
  data() {
    return {
      BrandID: "",
      searching: false,
      DepartmentID: ""
    };
  },
  methods: {
    selectBrand(el) {

      if(this.DepartmentID) {
        this.BrandID = el;
      }
    },
    filter() {
      
      if(this.DepartmentID === "") {

        this.searching = false;

        return {
          0: { 
            'id': null,
            'name': 'Sin resultados'
          }
        };
      }

      let filtered = this.options.filter(
        m => m.DepartmentID == this.DepartmentID
      );
              
      if (this.BrandID) {

        filtered = filtered.filter(
          m => m.name.toLowerCase().indexOf(this.BrandID) > -1
        );

      }

      return filtered;
    }
  },
  computed: {
    filterBrands: function() {

      if(this.DepartmentID === "") {

        return {
          0: { 
            'id': null,
            'name': 'Sin resultados'
          }
        };
      }

      let opts = this.options.filter(
        m => m.DepartmentID == this.DepartmentID
      );

      let filtered = opts;
              
      if (this.BrandID) {

        filtered = filtered.filter(
          m => m.name.toLowerCase().indexOf(this.BrandID) > -1
        );
      }

      return filtered;
    }
  },
  mounted() {
    this.$root.$on('DepartmentID', data => {
        this.DepartmentID = data;
    });
  }
};
</script>