<template>
        <div class="row">
			<div class="col-md-9 order-2 order-md-1 mb-4">
				<div class="accordion" id="accordionExample">
					<div :class="'card '" ref="card">
						<div class="card-header p-0" id="cardHead">
							<a class="btn green-link w-100 p-3 d-flex justify-content-start align-items-center" 
                                type="button" aria-expanded="true" data-toggle="collapse" data-target="#card" aria-controls="card" @click="selectOption('card')">
								<img :src="this.$root.path+'/img/logos/mercadopago.png'" class="mr-2 height-15" alt="">
								<span>Tarjetas de Crédito y Débito</span>	
							</a>
						</div>

						<div id="card" class="'collapse border-bottom show'" aria-labelledby="cardHead" data-parent="#accordionExample">
							<div class="card-body">
								<card-payment
									:csrf="csrf"
									:shipping="address.ShippingAddID"
									:shippingcost="shippingcost"
                                    :amount="walletBol"
								>
								</card-payment>			
							</div>
						</div>
					</div>
				</div>
			</div>			
            <div class="col-md-3 order-1 order-md-2 mb-4">
                <div class="card bg-light fit-height">
                    <div class="card-body w-full">
                        <h5 class="card-title"><b>Resumen del pedido</b></h5>

                        <div class="d-flex align-top mt-3" v-if="devtotal > 0">
                            <input 
                            class="switch-checkbox" 
                            type="checkbox"  
                            id="IsPaused" 
                            name="IsPaused" 
                            value="true"  
                            @click="wallet()"/>
                            <label for="IsPaused" class="switch-label m-0"></label>
                            <span class="ml-2 font-15">Aplicar cartera</span>
                            
                        </div>

                        <table class="w-100 mt-4">

                            <tr>
                                <td>Subtotal:</td>
                                <td class="text-right">${{ subtotal }} </td>
                            </tr>
                            <tr>
                                <td>Envio:</td>
                                <td class="text-right">${{ shippingcost }}</td>
                            </tr>
                        </table>
                        <hr>

                        <table class="w-100 mt-4">

                            <tr v-if="!walletBol">
                                <td> Total: </td>
                                <td class="text-right green-color">
                                    <h5><b>${{ total + shippingcost }}</b></h5>
                                </td>
                            </tr>
                            <tr v-else>
                                <td> Total: </td>
                                <td class="text-right">
                                    ${{ (total + shippingcost) }}
                                </td>
                            </tr>

                            <tr v-if="walletBol">
                                <td>En cartera:</td>
                                <td class="text-right">${{ devtotal }} </td>
                            </tr>

                            <tr v-if="walletBol">
                                <td>Total con cartera:</td>
                                <td class="text-right green-color">
                                    <h5><b>${{ devtotal > (total + shippingcost) ? 0 : (total + shippingcost) - devtotal }} </b></h5>
                                </td>
                            </tr>
                        </table>

                        <div class="alert alert-success w-100 p-2 mt-3 text-center font-13" 
                            role="alert"
                            v-if="walletBol && devtotal > (total + shippingcost)">
                            Te quedan ${{ devtotal - (subtotal + shippingcost)  }} en cartera.
                        </div>
                    </div>
                </div>
            </div>		
		</div>
</template>

<script>
    export default {

        props: {
            amount: {
                type: String,
            },
            address: {
                type: Object,
            },
            shippingcost: {
                type: Number,
            },
            subtotal: {
                type: Number,
            },
            total: {
                type: Number,
            },
            csrf: {
                type: String,
            },
            devtotal: {
                type: Number,
            } 
        },
        data() {
            return {
                walletBol : false,
                cardBol : false
            };
        },
        methods: {
            wallet() {
                this.walletBol = this.walletBol ? false : true;
            }
        },
        mounted() {

        }
    };
</script>
