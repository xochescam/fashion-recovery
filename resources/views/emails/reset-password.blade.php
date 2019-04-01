@extends('emails.master')

@section('content')

	<tr>
	    <td width="620" valign="top" style="background-color:#f7f7f7; border-bottom: 1px solid #eee; border-left: 1px solid #eee; border-right: 1px solid #eee; text-align: center;">
            <p style="color:#666; font:16px sans-serif; font-weight:700; line-height:1.5em; margin: 2em 0 0.5em; padding: 30px 40px 0; text-align: center;">
                Has solicitado restablecer tu contraseña.
            </p>

            <p style="color:#666; font:300 14px sans-serif; line-height:1.5em; margin: 1em 0; padding: 20px 40px 0;">
                Para hacerlo da clic en el siguiente enlace para restablecer tu contraseña:
            </p>

            <a href="{{ url($token) }}" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; border-radius: 3px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); color: #FFF; display: inline-block; text-decoration: none; -webkit-text-size-adjust: none; background-color: #009c77; border-top: 10px solid #009c77; border-right: 18px solid #009c77; border-bottom: 10px solid #009c77; border-left: 18px solid #009c77;">Restablecer contraseña</a>

            <p style="color:#666; font:300 14px sans-serif; line-height:1.5em; margin: 1em 0; padding: 20px 40px 50px;">
				Este enlace sólo es válido en los siguientes 60 minutos desde que recibes este mensaje. En caso de que expire, puedes solicitarlo nuevamente.<br>
				Si no solicitaste restablecer tu contraseña puedes ignorar este correo.
            </p>
	    </td>
	</tr>

@endsection