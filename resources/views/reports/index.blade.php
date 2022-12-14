@extends('dashboard.master')

@section('content')

	 <main id="main">
	    <div class="container py-5">
	      	<div class="row">
              <page-component
                :data="{{ json_encode($data) }}"
                :date="{{ json_encode($date) }}"
                :sellsall="{{ json_encode($sells) }}"
                :dep="{{ json_encode($departments) }}"
                :buyers="{{ json_encode($buyersList) }}"
                :sellers="{{ json_encode($sellersList) }}"
                :devs="{{ json_encode($returnList) }}"
                :shippinglist="{{ json_encode($shippingCost) }}"
                :banklist="{{ json_encode($transactions) }}"
              >
              </page-component>
			</div>
		</div>
	</main>
@endsection
