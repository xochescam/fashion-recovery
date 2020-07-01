@extends('emails.master')

@section('content')

    <tr>
	    <td width="700" valign="top">
	        <table cellpadding="0" cellspacing="0" border="0" align="center">
	            <tr>
	                <td width="700" valign="top">

	                	<p style="color: #444; font: 400 20px sans-serif; line-height: 1.6em; margin-top: 1.5em;padding: 0; text-align: center;">
                            Han solicitado una devolución.
	                    </p>

                        <p style="line-height: 25px; color: #444;font: 300 15px sans-serif;text-align: center; margin-bottom: 30px; margin-top: 20px;">
							Se ha solicitado una devolución con motivo de <b>{{ $rason }}</b>. <br> Ingresa a mis pedidos para ver el seguimiento de la prenda.
                        </p>

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