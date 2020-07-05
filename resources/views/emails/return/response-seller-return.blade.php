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
							La solicitud de la devolución ha sido <b>{{ $type == 'true' ? 'aprobado.' : 'cancelada.' }} </b>
						</p>

						<p style="margin-bottom: 50px; border-radius: 2px; background-color: #fff; font-style: italic;line-height: 25px; color: #444;font: 300 14px sans-serif;text-align: center; padding: 30px;">
							{{ $comments }} 
                        </p>					
	                </td>
	            </tr>
	        </table>
	    </td>
	</tr>

@endsection