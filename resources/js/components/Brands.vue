<template>

    <div>
        <div class="d-flex w-auto justify-content-between mb-4">

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" @click="filterBrands($event)">
                <label class="form-check-label" for="defaultCheck1" >
                    Mostrar marcas por validar
                </label>
            </div>

		    <a class="btn btn-fr" :href="$root.path + '/brands/create'" role="button">Crear</a>
		</div>

        <table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">Nombre</th>
					<th scope="col">Departamento</th>
					<th scope="col">Activa</th>
					<th scope="col"></th>
				</tr>
			</thead>
		    <tbody>
				<tr v-for="brand in marcas" :key="brand.BrandID">
					<th> {{ brand.BrandName }} </th>
                    <td> {{ getName(brand.DepartmentID)  }}</td>
					<td>
						<i class="fas fa-check green-color" v-if="brand.Active"></i>
						<i class="fas fa-times text-danger" v-else></i>
					</td>								    
					<td>
                        <a class="btn btn-sm btn-fr" :href="$root.path + '/brands/'+brand.BrandID+'/edit'" role="button">Modificar</a>
                        <a class="btn btn-sm btn-danger" :href="$root.path + '/brands/'+brand.BrandID+'/delete'" role="button">Eliminar</a>
                        <a class="btn btn-sm btn-warning text-light" :href="$root.path + '/brands/'+brand.BrandID+'/validate'" role="button" v-if="!brand.Verified">Validar</a>
				</td>
				</tr>
			</tbody>
		</table>
    </div>
</template>

<script>
    export default {
        props:{
            brands: {
                type: Array,
            },
            departments: {
                type: Object
            }
        },
        data() {
            return {
                marcas: this.brands
            }
        },
        methods : {
            getName(item) {
                if(!this.departments[item]) {
                    return;
                }

                for (let index = 0; index < this.departments[item].length; index++) {
                    const element = this.departments[item][index];
                    return element.DepName;
                }
            },
            filterBrands(e) {
                if(e.currentTarget.checked) {
                    this.marcas = this.marcas.filter((el) =>
                        !el.Verified
                    );
                } else {
                    this.marcas = this.brands;
                }
            }
        }
    };
</script>
