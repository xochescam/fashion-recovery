@extends('emails.master')

@section('content')
	<tr>
	    <td width="700" valign="top">
	        <table cellpadding="0" cellspacing="0" border="0" align="center">
	            <tr>
	                <td width="700" valign="top">

	                	<p style="color: #444; font: 400 20px sans-serif; line-height: 1.6em; margin-top: 1.5em;padding: 0; text-align: left; margin-left: 50px;">
	                        Un usuario te ha realizado una pregunta
	                    </p>

	                    <p style="color: #444; font: 400 15px sans-serif; line-height: 1.6em;padding: 0; text-align: left;margin-left: 50px;">
	                        El usuario {{ $AliasQuestion }} te ha hecho la siguiente pregunta:
	                    </p>

	                    <p style="color: #444;font: 300 15px sans-serif;margin-left: 50px;text-align: left; margin-bottom: 30px; margin-top: 20px;">
	                        "{{ $Question }}"
	                    </p>

	                    <div style="margin:50px;text-align:left;margin-top: 0px;display: inline-flex;">
	                        <a href="{{ url('question/'.$QuestionID.'/answer') }}" target="_blank" style="background-color: #009c77;
    color: #fff;display: inline-block;font: 400 14px/1 &quot;Open Sans&quot;, sans-serif;font-size: 0.875rem;padding: 1.2em 1.3em; transition: background-color 200ms ease-out;text-decoration: none;cursor: pointer;">
								Responder pregunta
							</a>
		                </div>
	                </td>
	            </tr>
	        </table>
	    </td>
	</tr>
@endsection