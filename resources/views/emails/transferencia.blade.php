@extends('emails.master')

@section('content')

	<tr>
	    <td width="620" valign="top" style="background-color:#f7f7f7; text-align: center;">
            <p style="color:#666; font:16px sans-serif; font-weight:700; line-height:1.5em; margin: 2em 0 0.5em; padding: 30px 40px 0; text-align: center;">
                Solicitud de transferencia.
            </p>

            <p style="color:#666; font:300 14px sans-serif; line-height:1.5em; margin: 1em 0; padding: 20px 40px 0;">
                Te notificamos que hemos realizado la transferencia que has solicitado.
            </p>

            <a href="{{ url('sales') }}" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; border-radius: 3px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); color: #FFF; display: inline-block; text-decoration: none; -webkit-text-size-adjust: none; background-color: #009c77; border-top: 10px solid #009c77; border-right: 18px solid #009c77; border-bottom: 10px solid #009c77; border-left: 18px solid #009c77; margin-bottom: 30px;">
                Ir a mis ventas
            </a>

	    </td>
	</tr>

@endsection