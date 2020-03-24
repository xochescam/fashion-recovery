<header-component
  :instantsearch="false"
  :authdata="{{ Auth::User() !== null ? Auth::User() : '{}' }}"
  :countitemsdata="{{ Auth::User() !== null  ? count(Auth::User()->getItems()) : 0 }}"
  :notificationsdata="{{ Auth::User() !== null  ? Auth::User()->getNotifications() : '[]' }}"
  sellerurl="{{ (!isset(Auth::User()->ProfileID) || (isset(Auth::User()->ProfileID) 
          && Auth::User()->ProfileID == 1)) ? 
          Auth::User() !== null ? url('seller') : url('register',1) :  '' }}"
></header-component>