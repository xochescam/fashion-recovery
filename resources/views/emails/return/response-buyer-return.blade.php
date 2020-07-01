@extends('emails.master')

@section('content')

    <tr>
	    <td width="700" valign="top">
	        <table cellpadding="0" cellspacing="0" border="0" align="center">
	            <tr>
	                <td width="700" valign="top">

	                	<p style="color: #444; font: 400 20px sans-serif; line-height: 1.6em; margin-top: 1.5em;padding: 0; text-align: center;">
                            Respuesta de solicitud de devolución
	                    </p>

                        <p style="line-height: 25px; color: #444;font: 300 15px sans-serif;text-align: center; margin-bottom: 30px; margin-top: 20px;">
							Tu solicitud de devolución ha sido <b>{{ $type == 'true' ? 'aprobada.' : 'cancelada.' }} </b> <br>
							{{ $type == 'true' ? 'Nos pondremos en contacto contigo para realizar tu rembolso.' : 'Lamentamos no tener evidencias suficientes para aprobarla.' }} 
                        </p>
						
	                </td>
	            </tr>
	        </table>
	    </td>
	</tr>

@endsection