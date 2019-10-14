<h1>Error en Fashion Recovery</h1>
<h3>Información del error:</h3>
<p><strong>Date:</strong> {{ date('M d, Y H:iA') }}</p>
<p><strong>Message:</strong> {{ $e->getMessage() }}</p>
<p><strong>Code:</strong> {{ $e->getCode() }}</p>
<p><strong>File:</strong> {{ $e->getFile() }}</p>
<p><strong>Line:</strong> {{ $e->getLine() }}</p>
<p><strong>User:</strong> {{ isset(Auth::User()->id) ? Auth::User()->id : '' }}</p>
<h3>Stack trace:</h3>
<pre>{{ $e->getTraceAsString() }}</pre>