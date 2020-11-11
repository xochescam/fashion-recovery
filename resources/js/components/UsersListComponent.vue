<template>

    <div>

        <table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">Usuario</th>
                    <th scope="col">Compras</th>
                    <th scope="col">Ventas</th>
                    <th scope="col">Cartera</th>
				</tr>
			</thead>
		    <tbody>
				<tr v-for="user in data" :key="user.id">
                    <th> 
                        <a 
                            :href="$root.path + '/user/' + user['alias']" 
                            class="green-link">
                            {{ user['alias'] }}
                        </a> 
                    </th>
                    <td> {{ user['buys'] }} </td>
                    <td> {{ user['sells'] }} </td>
                    <td> {{ user['cartera'] }} </td>
				</tr>
			</tbody>
		</table>
    </div>
</template>

<script>
    export default {
        props:{
            users: {
                type: Array,
            }
        },
        data() {
            return {
                data: this.users
            }
        },
    };
</script>
