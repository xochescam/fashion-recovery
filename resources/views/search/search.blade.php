<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Ion.RangeSlider -->
<!--     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
 -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Fontawesome ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.css" />

    <!-- <link rel="stylesheet" href="css/bootstrap.min.css" /> -->
    <link rel="stylesheet" href="{{ url('css/app.css?1') }}" />

    <link rel="shortcut icon" href="{{ url('img/favicon.jpg') }}">

    <title>FASHION RECOVERY</title>
  </head>
  <body data-root="{{ url('/') }}">

    <div id="app">

      <search-page
        cancategory="{{ Auth::User() !== null && Auth::User()->isAdmin() }}"
        canseller="{{ Auth::User() !== null && Auth::User()->isBuyerProfile() }}"
        canbuyitem="{{ Auth::User() !== null && (Auth::User()->isBuyerProfile() || Auth::User()->isSellerProfile()) }}"
        canpersonalinfo="{{ Auth::User() !== null && (Auth::User()->isBuyerProfile() || Auth::User()->isSellerProfile()) }}"
        canorders="{{ Auth::User() !== null && (Auth::User()->isBuyerProfile() || Auth::User()->isSellerProfile()) }}"
        canitem="{{ Auth::User() !== null && Auth::User()->isSellerProfile() }}"
        canwishlist="{{ Auth::User() !== null && (Auth::User()->isBuyerProfile() || Auth::User()->isSellerProfile()) }}"
        cannotifications="{{ Auth::User() !== null && (Auth::User()->isBuyerProfile() || Auth::User()->isSellerProfile()) }}"
        :wishlistdata="{{ $wishlist === [] ? '[]' : $wishlist }}"
        brands="{{ json_encode($brands) }}"
        searchdata="{{ $search }}"
        :authdata="{{ Auth::User() !== null ? Auth::User() : '{}' }}"
        :countitemsdata="{{ Auth::User() !== null  ? count(Auth::User()->getItems()) : 0 }}"
        :notificationsdata="{{ Auth::User() !== null  ? Auth::User()->getNotifications() : '[]' }}"
        sellerurl="{{ (!isset(Auth::User()->ProfileID) || (isset(Auth::User()->ProfileID) 
          && Auth::User()->ProfileID == 1)) ? 
          Auth::User() !== null ? url('seller') : url('register',1) :  '' }}"
      >
      </search-page>
    </div>

    @include('layout.footer')

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/instantsearch.js@2.10.4/dist/instantsearch.min.css">
    <script src="https://cdn.jsdelivr.net/npm/instantsearch.js@2.10.4"></script>


    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="{{ url('js/search-components.js') }} "></script>

    <script type="text/javascript" src="{{ url('js/public.js?1.0') }} "></script>
    
  </body>
</html>