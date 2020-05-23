@extends('emails.master')

@section('content')
	<tr>
	    <td width="700" valign="top">
	        <table cellpadding="0" cellspacing="0" border="0" align="center">
	            <tr>
	                <td style="padding-top: 40px;padding-bottom: 40px;" width="700px" valign="top">

	                    <p style="color: #444; font: 400 15px sans-serif; line-height: 1.6em;padding: 0; text-align: left;margin-left: 50px;">
							¡Hola <b>{{ $name }}</b>, te damos la bienvenida a FASHION RECOVERY!
	                    </p>

	                    <p style="color: #444;font: 300 15px sans-serif;margin-left: 50px;margin-right: 50px;text-align: left; margin-bottom: 30px; margin-top: 20px;">
						Tu cuenta ha sido activada exitosamente, ahora solo nos falta confirmar que esta es tu dirección de correo electrónico.
	                    </p>

	                    <div style="margin-right:50px;margin-left:50px;width: 700px;margin-top: 0px;display: inline-flex;margin-bottom: 10px;">
	                        <a href="{{ url('confirm-account/'.$UserID.'/'.$beSeller) }}" target="_blank" style="background-color: #009c77;margin: auto;
    color: #fff;display: inline-block;font: 400 14px/1 &quot;Open Sans&quot;, sans-serif;font-size: 0.875rem;padding: 1.2em 1.3em; transition: background-color 200ms ease-out;text-decoration: none;cursor: pointer;">
								Confirmar mi cuenta
							</a>
						</div>
						
						<p style="color: #444;font: 300 15px sans-serif;margin-left: 50px;margin-right: 50px;text-align: left; margin-bottom: 30px; margin-top: 20px;">
							Atentamente, El equipo de FASHION RECOVERY
						</p>
						
						<p style="color: #444;font: 300 15px sans-serif;margin-left: 50px;margin-right: 50px;text-align: left; margin-bottom: 30px; margin-top: 20px;">
							<b>Nota:</b> No respondas a este mensaje de correo electrónico. Se ha
							enviado desde una dirección exclusiva para notificaciones que no
							acepta mensajes entrantes. Si no te has registrado en FASHION
							RECOVERY y crees que tu correo electrónico ha sido utilizado por
							alguien más, <a href="#" style="text-decoration: none;color: #444"> <b>puedes eliminar la cuenta</b> </a>
	                    </p>
	                </td>
	            </tr>
	        </table>
	    </td>
	</tr>
@endsection