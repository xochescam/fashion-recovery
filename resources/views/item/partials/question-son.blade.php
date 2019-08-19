<div class="mt-3 ml-5 question-son">
  <div class="mr-5">
  	<p>
  		{{ $question->answers->first()->Question }}<br>
    	<small>Por 
			@if( $question->answers->first()->ProfileID === 2)
				<a class="green-link" href="{{ url('seller',$question->answers->first()->Alias) }}">{{ $question->answers->first()->Name }}</a>
			@else
				{{ $question->answers->first()->Name }}
			@endif

			el {{ $question->answers->first()->date }}
    	</small>

    	@if(count($question->answers) > 1)
    		<small>
				<a href="#collapseExample"  data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" class="green-link"><br>
					<i class="fas fa-chevron-down"></i>
					<b>Ver más respuestas ({{ count($question->answers) - 1 }})</b>
				</a>
			</small>
    	@endif
  	</p>
  </div>
</div>

@if(count($question->answers) > 1)
	<div class="collapse" id="collapseExample">
    	@foreach($question->filterAnsw as $asnwer)
			<div class="ml-5">
		      <div class="mr-5">
		      	<p>
		      		{{ $asnwer->Question }}<br>
		        	<small>Por 
						@if($asnwer->ProfileID === 2)
							<a class="green-link" href="{{ url('seller',$asnwer->Alias) }}">{{ $asnwer->Name }}</a>
						@else
							{{ $asnwer->Name }}
						@endif

						el {{ $asnwer->date }}
		        	</small>
		      	</p>
		      </div>
		    </div>
		@endforeach
	</div>
@endif