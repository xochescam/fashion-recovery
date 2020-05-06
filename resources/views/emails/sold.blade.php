@extends('emails.master')

@section('content')
	<tr>
	    <td width="700" valign="top">
	        <table cellpadding="0" cellspacing="0" border="0" align="center">
	            <tr>
	                <td width="700" valign="top">

	                	<p style="color: #444; font: 400 20px sans-serif; line-height: 1.6em; margin-top: 1.5em;padding: 0; text-align: center;">
                            ¡Felicidades, tu compra ha sido procesada!
	                    </p>

	                    <p style="color: #444;font: 300 15px sans-serif;margin-left: 50px;text-align: left; margin-bottom: 30px; margin-top: 20px;">
                            <b>Dirección de envío</b> <br>

                            {{ count($items) }} producto{{ count($items) > 1 ? 's' : '' }} se enviar{{ count($items) > 1 ? 'án' : 'á' }} a {{ $Alias }} 
							<br> En {{ $address[0]->Street }} {{ $address[0]->Suburb }} {{ $address[0]->Suburb }} {{ $address[0]->ZipCode }} por parte de fashionrecovery.com
	                    </p>

                        <p style="color: #444;font: 300 15px sans-serif;margin-left: 50px;text-align: left; margin-bottom: 30px; margin-top: 20px;">
                            <b>Método de pago:</b> xxxx xxxx xxxx x245 BBVA 
	                    </p>

                        <p style="color: #444;font: 300 15px sans-serif;margin-left: 50px;text-align: left; margin-bottom: 30px; margin-top: 20px;">
                            <b>Total del pedido:</b> ${{ $Total }}
	                    </p>

						<ul style="font: 200 14px sans-serif;border-top: 1px solid rgba(0,0,0,.125); margin-left: 50px; margin-right: 50px; padding: 0px;  width: 700px; margin-top: 20px;">

			          		@foreach($items as $item)

			          			<li style="display:block; border-bottom: 1px solid rgba(0,0,0,.125);">
							  		<div style="display: flex;">
									    <div style="width: 30%;">
									      <img src="{{ url('storage/'.$item->ThumbPath) }}" alt="">
									    </div>
									    <div style="width: 70%; padding-left: 20px;">
									      <div>
									      	<div>
												<p>{{ $item->ItemDescription }}</p>
									      		<p>{{ $item->ActualPrice }}</p>
									      	</div>
									      	<p>
									      		<small>Talla: {{ $item->SizeID }}</small> <br>
												<small>Marca: {{ $item->BrandName }}</small> <br>
												<small>Vendedor: {{ $item->Alias }}</small>
									      	</p>
									      </div>
									    </div>
									</div>
						  		</li>

			          		@endforeach
						</ul>

	                    <div style="text-align:center;margin:auto;display: block;width:700px; margin-bottom: 50px; margin-top: 50px;">
	                        <a href="{{ url('orders') }}" target="_blank" style="background-color: #009c77;
    color: #fff;display: inline-block;font: 400 14px/1 &quot;Open Sans&quot;, sans-serif;font-size: 0.875rem;padding: 1.2em 1.3em; transition: background-color 200ms ease-out;text-decoration: none;cursor: pointer;">
    							Ver pedido 
							</a>
		                </div>
	                </td>
	            </tr>
	        </table>
	    </td>
	</tr>
@endsection