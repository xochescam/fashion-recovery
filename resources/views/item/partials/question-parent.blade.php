@if(isset($questions))
	@foreach($questions as $question)

		<div class="mb-4 question-parent">
			<p class="border-left pl-3">
				{{ $question->Question }}<br>
				<small>Por

					@if($question->ProfileID === 2)
						<a class="green-link" href="{{ url('user',$question->Alias) }}">{{ $question->Name }}</a>
					@else
						{{ $question->Name }}
					@endif

					el {{ $question->date }}</small>
			</p>

			@if(count($question->answers) > 1)
				@include('item.partials.question-son')

			@elseif(count($question->answers) == 1)
				@include('item.partials.question-son')
			@endif
		</div>
		
	@endforeach

@else
	<div class="mb-4 question-parent">
		<p class="border-left pl-3">
			{{ $question->Question }}<br>
			<small>Por

				@if($question->ProfileID === 2)
					<a class="green-link" href="{{ url('user',$question->Alias) }}">{{ $question->Name }}</a>
				@else
					{{ $question->Name }}
				@endif

				el {{ $question->date }}</small>
		</p>

		@if(count($question->answers) > 1)
			@include('item.partials.question-son')

		@elseif(count($question->answers) == 1)
			@include('item.partials.question-son')
		@endif
	</div>
@endif

