@extends('emails.master')

@section('content')

    <tr>
	    <td width="700" valign="top">
	        <table cellpadding="0" cellspacing="0" border="0" align="center">
	            <tr>
	                <td width="700" valign="top">

	                	<p style="color: #444; font: 400 20px sans-serif; line-height: 1.6em; margin-top: 1.5em;padding: 0; text-align: center;">
							El comprador ha solicitado proceso de devolución.
	                    </p>

                        <p style="line-height: 40px; color: #444;font: 300 15px sans-serif;text-align: center; margin: 20px 20px 30px 20px;">
							Se ha solicitado una devolución de la siguiente prenda:<br>
                        </p>

						<ul style="font: 200 14px sans-serif;border-top: 1px solid rgba(0,0,0,.125); margin-left: 50px; margin-right: 50px; padding: 0px;  width: 700px; margin-top: 20px;">
			          			<li style="display:block; border-bottom: 1px solid rgba(0,0,0,.125);">
							  		<div style="display: flex;">
									    <div style="width: 300px;">
									      <img src="{{ url('storage/'.$item->ThumbPath) }}" alt="">
									    </div>
									    <div style="width: 400px; padding-left: 20px;">
									      <div>
									      	<div>
												<p>{{ $item->ItemDescription }}</p>
									      		<p>{{ $item->ActualPrice }}</p>
									      	</div>
									      </div>
									    </div>
									</div>
						  		</li>
						</ul>

						<p style="border-radius: 2px; background-color: #fff; font-style: italic;line-height: 25px; color: #444;font: 300 14px sans-serif;text-align: left; padding: 30px;">
							<b>Motivo: </b> {{ $rason }}<br> <br> 
							<b>Comentario: </b> <br>
							{{ $comments }}  
                        </p>

						<p style="line-height: 40px; color: #444;font: 300 15px sans-serif;text-align: center; margin: 20px 20px 30px 20px;">
							Tienes 24 horas para contestar y enviar evidencia de la petición. <br><br>
							Para mayor infomación acerca del proceso de devolución, te invitamos a verificar nuestros 
							<a style="color: #009c77;font: 300 15px sans-serif;" href="{{ url('terms') }}">Términos y condiciones</a>.
                        </p>
						
	                    <div style="text-align:center;margin:auto;display: block;width:700px; margin: 20px 20px 30px 20px;">
	                        <a href="{{ url('comments-return/'.$return.'/false') }}" target="_blank" style="background-color: #009c77;
    color: #fff;display: inline-block;font: 400 14px/1 &quot;Open Sans&quot;, sans-serif;font-size: 0.875rem;padding: 1.2em 1.3em; transition: background-color 200ms ease-out;text-decoration: none;cursor: pointer;">
								Enviar evidencia
							</a>
		                </div>
						
	                </td>
	            </tr>
	        </table>
	    </td>
	</tr>

@endsection