@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <div class="row">
          <h2 class="text-center TituloFR my-4 mb-5 w-100"> {{ $type == 'answer' ? '¿Tienes una pregunta?' : 'Contestar pregunta' }}</h2>

          <p class="text-center mb-5 w-100">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit qui ad, commodi nostrum repudiandae ipsam soluta excepturi.</p>

          <div class="col-md-8 offset-md-2">
            <form method="GET" action="{{ url('question',$type) }}" class="needs-validation" novalidate>

            @include('alerts.success')
            @include('alerts.warning')

              @include('item.partials.question-parent')

              <input type="hidden" name="QuestionID" value="{{ $question->QuestionID }}">
              <input type="hidden" name="id" value="{{ $question->ItemID }}">
              <input type="hidden" name="questionUser" value="{{ $question->UserID }}">

              <div class="form-group">
                <label for="answer"> {{ $type == 'answer' ? '¿Tienes una pregunta?' : 'Contestar pregunta' }} </label>
                <textarea class="form-control" name="answer" id="answer" rows="2" required></textarea>

                @if ($errors->has('answer'))
                  <div class="invalid-validation">
                    {{ $errors->first('answer') }}
                  </div>
                @else
                  <div class="invalid-feedback">
                    Ingresa una respuesta.
                  </div>
                @endif

            </div>

              <div class="text-center mt-5">
                <button type="submit" class="btn btn-fr w-25">
                  <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
                  {{ $type == 'answer' ? 'Preguntar' : 'Contestar' }}
               </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
@endsection
