@extends('emails.master')

@section('content')
	<tr>
	    <td width="700" valign="top">
	        <table cellpadding="0" cellspacing="0" border="0" align="center">
	            <tr>
	                <td width="700" valign="top">

	                	<p style="color: #444; font: 400 20px sans-serif; line-height: 1.6em; margin-top: 1.5em;padding: 0; text-align: left; margin-left: 50px;">
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

	                    <div style="margin:50px;text-align:left;margin-top: 0px;display: inline-flex;">
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