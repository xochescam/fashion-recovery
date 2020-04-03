@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <div class="row">
          <div class="col-md-10 offset-md-1">
            <h2 class="text-center TituloFR my-4 mb-5">Registro de vendedor</h2>

            <form method="POST" action="{{ url('seller') }}" enctype="multipart/form-data" class="needs-validation" novalidate>

              {!! csrf_field() !!}
              @include('alerts.success')
              @include('alerts.warning')

              <create-seller
                :states="{{ json_encode($states) }}"
                :errors="{{ count($errors) > 0 ? $errors : '{}'  }}"
                :old="{{ count(Session::getOldInput()) > 0 ? json_encode(Session::getOldInput()) : '{}'}}"
              >
              </create-seller>
            </form>
          </div>
        </div>
      </div>
    </main>
@endsection
