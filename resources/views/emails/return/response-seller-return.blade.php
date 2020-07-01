@extends('emails.master')

@section('content')

    <tr>
	    <td width="700" valign="top">
	        <table cellpadding="0" cellspacing="0" border="0" align="center">
	            <tr>
	                <td width="700" valign="top">

	                	<p style="color: #444; font: 400 20px sans-serif; line-height: 1.6em; margin-top: 1.5em;padding: 0; text-align: center;">
                            Respuesta de evidencia de devolución
	                    </p>

                        <p style="line-height: 25px; color: #444;font: 300 15px sans-serif;text-align: center; margin-bottom: 30px; margin-top: 20px;">
							La evidencia de devolución ha sido <b>{{ $type == 'true' ? 'cancelada.' : 'aprobada.' }} </b> <br>
							{{ $type == 'true' ?  'Lamentamos no poder ayudarte en esta ocasión.' : 'Puedes volver a publicar tu prenda nuevamente.' }} 
                        </p>
						
	                </td>
	            </tr>
	        </table>
	    </td>
	</tr>

@endsection