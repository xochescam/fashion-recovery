<!DOCTYPE html>
<html>
	
	<head>
	<meta charset="utf-8">
		<title></title>
	</head>
	<body>
		<table cellpadding="0" cellspacing="0" border="0" style="line-height: 100% !important; margin:0; padding:0; width:100% !important;">
		    <tr>
		        <td>
		            <table cellpadding="0" cellspacing="0" border="0" align="center" style="background-color:#f7f7f7;margin:60px auto;min-width: 500px;width: 500px;">

						@include('emails.header')
		                <tr>
		                    <td width="500" valign="top">
		                        <table cellpadding="0" cellspacing="0" border="0" align="center">

									@yield('content')

									@include('emails.footer')
								</table>
		                    </td>
		                </tr>
		            </table>
		        </td>
		    </tr>
		</table>
	</body>
</html>