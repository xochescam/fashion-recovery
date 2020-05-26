<template>

	<div class="row">
		<div :class="'order-2 order-md-1 '+( allItems.length > 0 ? 'col-md-9 mb-4' : ' w-100' )">

            <div v-if="allItems.length > 0">
                <p class="font-weight-bold w-100 text-right px-4 d-none d-md-block">Precio</p>

                <ul class="list-group list-group-flush w-100">
                    <li class="list-group-item" 
                            v-for="(item, key) in allItems"
                            :key="key"
                            :value="key">
                            <div class="row no-gutters">
                                <div class="col-md-3">
                                    <img :src="url+'/storage/'+item.ThumbPath" class="card-img" :alt="item.BrandName">
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body">
                                        <div class="row">
                                            <p class="col col-md-10">{{ item.ItemDescription }}</p>
                                            <p class="font-weight-bold text-right green-color p-0 col col-md-2">{{ item.ActualPrice }}</p>
                                        </div>
                                        <p>
                                            <small>Talla: {{ item.SizeID }}</small> <br>
                                            <small>Marca: {{ item.BrandName }}</small> <br>
                                            <small>Vendedor: {{ item.Alias }}</small>
                                        </p>

                                        <p class="card-text">
                                            <small class="text-muted">
                                                <a class="text-danger cursor-pointer" @click="removeFromShoppingCart(item.ItemID)">Eliminar</a>
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                </ul>
                            
                <p class="w-100 text-right px-4 mt-3">Subtotal ({{ allItems.length }} producto{{ allItems.length > 1 ? 's' : '' }}): 
                <span class="font-weight-bold green-color">${{ total }} </span></p>
            </div>

			<p class="text-center green-color"  v-else>No tienes productos en el carrito.</p>
		</div>

		<div class="col-md-3 order-1 order-md-2 mb-4" v-if="allItems.length > 0">
			<div class="card bg-light fit-height">
				<div class="card-body w-full">
					<h5 class="card-title"><b>Resumen del pedido</b></h5>

					<table class="w-100 mt-4">
						<tr>
							<td>Subtotal:</td>
							<td class="text-right">{{ total }}</td>
						</tr>
						<tr>
							<td>Envio:</td>
							<td class="text-right">$0</td>
						</tr>
					</table>
					<hr>

					<table class="w-100 mt-4">
						<tr>
							<td>Total:</td>
							<td class="text-right green-color">
								<h5><b>{{ total }}</b></h5>
						    </td>
						</tr>
					</table>

					<a :href="url+'/address'" class="btn btn-fr w-100 mt-2">Proceder al pago</a>
				</div>							
			</div>
		</div>
	</div>

</template>

<script>
    export default {

        props: {

            /**
             * Receive an initial selected value.
             */
            items: {
                type: String,
                required: true,
                default: ''
            },
            amount: {
                type: String,
                required: true,
                default: ''
            }
        },
        data() {
            return {
                allItems: {},
                total: this.amount,
                url: ''
            };
        },
        methods: {

            removeFromShoppingCart: function (ItemID) {

                axios
                    .get(window.location.origin+'/delete-to-cart/'+ItemID)
                    .then(response => {

                        let res       = response.data;
                        let isSuccess = res.response === 'success' ? true : false;
                        let alert     = document.querySelector('.alert-'+res.response);
                        let badge     = document.querySelector('.badge-notifications');
                        let count     = parseInt(badge.innerText);
                        let span      = alert.querySelector('span');

                        badge.innerText     = isSuccess ? count - 1 : count;

                        if(isSuccess) {
                            const key = this.allItems.findIndex(x => x.ItemID === ItemID);
                            this.allItems.splice(key, 1);
                        }

                        alert.classList.remove('d-none');
                        span.innerText = res.message;

                        this.sumTotal();
                    })
                    .catch(error => {
                        console.log(error);
                })                
            },
            sumTotal() {
                let totalSum  = 0;

                this.allItems.forEach(obj => {
                    totalSum += parseFloat(obj.ActualPrice.substr(1));
                });

               //this.total = totalSum;
            },
        },
        mounted() {       
            
            
            this.allItems = JSON.parse(this.items);  
            this.url = window.location.origin;
            this.sumTotal();            
        }
    };
</script>
