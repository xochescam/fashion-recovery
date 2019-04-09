@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <h2 class="text-center TituloFR my-4">Modificar calendario de oferta</h2>

            <form method="POST" action="{{ route('calendar-sales.update',$calendarSale->CalendarSalesID) }}" class="was-validated">
              @include('catalogs.calendar-sale.form')
            </form>
          </div>
        </div>
      </div>
    </main>
@endsection