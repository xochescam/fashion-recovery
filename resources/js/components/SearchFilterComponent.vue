<template>
   <div>
        <form class="row mb-3">
            <div class="col-10">

                <h6 class="font-weight-bold mt-3">DEPARTAMENTO</h6>
                    <div class="form-check" 
                        v-for="(department, key) in departments"
                        :key="key"
                        :value="key">
                        <input 
                            class="form-check-input filter-option departments-filters" 
                            type="checkbox" 
                            :value="key" 
                            :id="'DepartmentID-'+department.id" 
                            name="DepartmentID"
                            :checked="department.checked"
                            @change="filter()">
                        <label class="form-check-label" :for="'DepartmentID-'+department.id" >
                            {{ key }}
                        </label>
                        <span class="badge badge-fr">{{ department.count }}</span>
                    </div>

                <h6 class="font-weight-bold mt-4">TIPO DE PRENDA</h6>
                    <div class="form-check"
                        v-for="(clothingType, key) in clothingTypes"
                        :key="key"
                        :value="key"
                        >
                        <input 
                            class="form-check-input filter-option clothingTypes-filters" 
                            type="checkbox" 
                            :value="key"  
                            :id="'ClothingTypeID-'+clothingType.id" 
                            name="ClothingTypeID"
                            :checked="clothingType.checked"
                            @change="filter()">
                        <label class="form-check-label" :for="'ClothingTypeID-'+clothingType.id" >
                            {{ key }}
                        </label>
                        
                        <span class="badge badge-fr">{{ clothingType.count }}</span>
                    </div>

                <h6 class="font-weight-bold mt-4">MARCA</h6>
                    <div class="form-check"
                        v-for="(brand, key) in brands"
                        :key="key"
                        :value="key">
                        <input 
                            class="form-check-input filter-option brands-filters" 
                            type="checkbox" 
                            :value="key" 
                            :id="'BrandID-'+brand.id"
                            name="BrandID" 
                            :checked="brand.checked"
                            @change="filter()">
                        <label class="form-check-label" :for="'BrandID-'+brand.id">
                            {{ key }}
                        </label>
                        <span class="badge badge-fr">{{ brand.count }}</span>
                    </div>

                <h6 class="font-weight-bold mt-4">COLOR</h6>
                    <div class="form-check"
                        v-for="(color, key) in colors"
                        :key="key"
                        :value="key">
                        <input 
                            class="form-check-input filter-option colors-filters" 
                            type="checkbox" 
                            :value="key" 
                            :id="'ColorID-'+color.id"
                            name="ColorID" 
                            :checked="color.checked"
                            @change="filter()">
                        <label class="form-check-label" :for="'ColorID-'+color.id">
                            {{ key }}
                        </label>
                        <span class="badge badge-fr">{{ color.count }}</span>
                    </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: {

            /**
             * Receive an initial selected value.
             */
            filters: {
                type: String,
                required: true
            },
        },
        data() {
            return {
                departments: [],
                clothingTypes: [],
                brands: [],
                colors: []
            };
        },
        methods: {
            filter() {

                const container     = document.querySelector('#container-filters');
                const departments   = this.getChecked('departments');
                const clothingTypes = this.getChecked('clothingTypes');
                const brands        = this.getChecked('brands');
                const colors        = this.getChecked('colors');

                const formData = new FormData();
                formData.append('departments', departments);
                formData.append('clothingTypes', clothingTypes);
                formData.append('brands', brands);
                formData.append('colors', colors);                

                axios
                    .post(window.location.origin+'/filter', formData)
                    .then(response => {

                        container.innerHTML = '';

                        console.log(response.data.items);
                        

                        this.getItems(response.data.items, container)
                        
                        this.departments   = response.data.filters.departments;
                        this.clothingTypes = response.data.filters.clothingTypes;
                        this.brands        = response.data.filters.brands;
                        this.colors        = response.data.filters.colors;
                    })
                    .catch(error => {
                        console.log(error)
                    }) 

/*                 axios
                    .get(window.location.origin+'/filter/' + type + '/' + search)
                    .then(response => {

                        this.departments   = response.data.filters.departments;
                        this.clothingTypes = response.data.filters.clothingTypes;
                        this.brands        = response.data.filters.brands;
                        this.colors        = response.data.filters.colors;
                    })
                    .catch(error => {
                        console.log(error)
                    }) */
            },
            getItems(results, container) {

                for (const el in results) {
                    
                    var item = `<div class="col-lg-3 col-md-4 col-sm-6 mb-4 mt-4">
                        <a href="{{ url('login/0') }}"><i class="far fa-heart heart-wishlist"></i></a>
                        <a href="{{ url('items/`+results[el].ItemID+`/public') }}" class="link-card">
                            <div class="card card--public card--item shadow p-3 bg-white rounded d-flex align-items-stretch h-100">
                        
                                <img class="card-img-top" src="`+window.location.origin+'/'+results[el].ThumbPath+`" alt="`+results[el].brand+`" height="200px;">

                                <div class="card-body px-0 p-lg-3">

                                <h4 class="card-title mb-0">`+results[el].brand+`</h4>

                                <div class="float-right">
                                    <span class="mr-2 text-black-50">
                                    <del>`+results[el].OriginalPrice+`</del>
                                    </span>

                                    <p class="badge alert-success badge-price">
                                    `+results[el].ActualPrice+`
                                    </p>
                                </div>
                                        
                                <div class="container-fade txt-fade">
                                    <p>`+results[el].ItemDescription+`</p>
                                </div>
                                <p class="card-text" style="border-bottom: 1px solid gray; border-top: 1px solid gray;">
                                Talla: `+results[el].size+` <br />Color: `+results[el].ColorName+`</p>
                            </div>
                            </div>
                        </a>
                    </div>`

                    container.insertAdjacentHTML('beforeend', item);
                }
            },
            getChecked(type) {
                const inputs = Object.values(document.querySelectorAll('.'+type+'-filters'));

                const filter = inputs.map(function(input) {

                    if(input.checked) {
                        return input.value;
                    } 
                });

                return filter.filter(
                    m => m !== undefined
                );
            }
        },
        mounted() {
            
            this.departments   = JSON.parse(this.filters).departments;
            this.clothingTypes = JSON.parse(this.filters).clothingTypes;
            this.brands        = JSON.parse(this.filters).brands;
            this.colors        = JSON.parse(this.filters).colors;

            
        }
    }
</script>
