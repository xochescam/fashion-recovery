@extends('emails.master')

@section('content')
	<tr>
	    <td width="700" valign="top">
	        <table cellpadding="0" cellspacing="0" border="0" align="center">
	            <tr>
	                <td width="700" valign="top">

	                	<p style="color: #444; font: 400 20px sans-serif; line-height: 1.6em; margin-top: 1.5em;padding: 0; text-align: left; margin-left: 50px;">
	                        Nuevo seguidor
	                    </p>

	                    <p style="color: #444; font: 400 15px sans-serif; line-height: 1.6em;padding: 0; text-align: left;margin-left: 50px;">
	                        Hola {{ $name }}, bienvenido(a) a Fashion Recovery
	                    </p>

	                    <p style="color: #444;font: 300 15px sans-serif;margin-left: 50px;text-align: left;;    margin-bottom: 30px; margin-top: 20px;">
	                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis excepturi laudantium dolores vitae delectus. Deserunt itaque quia at recusandae, soluta, impedit hic corrupti architecto, qui esse eveniet deleniti nam quaerat.
	                    </p>
	                </td>
	            </tr>
	        </table>
	    </td>
	</tr>
@endsection