@extends('emails.master')

@section('content')
	<tr>
	    <td width="700" valign="top">
	        <table cellpadding="0" cellspacing="0" border="0" align="center">
	            <tr>
	                <td width="700" valign="top">

	                    <p style="color: #444; font: 300 15px sans-serif; line-height: 1.6em; margin: 1.5em 0 1.5em; padding: 0; text-align: center;">
	                        ¡Hola, {{ $name }}!
	                    </p>

	                    <p style="color: #444;font: 16px sans-serif;margin: 20px;text-align: center;font-weight: bold;    margin-bottom: 40px;">
	                        Recuerda confirmar tu cuenta.
	                    </p>

	                    <div style="margin:50px;text-align:center;margin-top: 0px;">
	                        <a href=" {{ url('confirm-account/'.$UserID.'/'.$beSeller) }} " target="_blank" style="background-color: #009c77;
    color: #fff;display: inline-block;font: 400 14px/1 &quot;Open Sans&quot;, sans-serif;font-size: 0.875rem;padding: 1em 1.3em; transition: background-color 200ms ease-out;text-decoration: none;cursor: pointer;">
								Confirmar
							</a>
		                </div>
	                </td>
	            </tr>
	        </table>
	    </td>
	</tr>
@endsection