@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <question-page
          type="{{ $type }}"
          :errors="{{ $errors }}"
          :question="{{ json_encode($question) }}"
          warning="{{ Session::has('warning') ? Session::get('warning') : '' }}"
        >
        </question-page>
      </div>
    </main>
@endsection
