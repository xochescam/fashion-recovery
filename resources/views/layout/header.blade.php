<header-component
  cancategory="{{ Auth::User() !== null && Auth::User()->isAdmin() }}"
  canseller="{{ Auth::User() !== null && Auth::User()->isBuyerProfile() }}"
  canbuyitem="{{ Auth::User() !== null && (Auth::User()->isBuyerProfile() || Auth::User()->isSellerProfile()) }}"
  canpersonalinfo="{{ Auth::User() !== null && (Auth::User()->isBuyerProfile() || Auth::User()->isSellerProfile()) }}"
  canorders="{{ Auth::User() !== null && (Auth::User()->isBuyerProfile() || Auth::User()->isSellerProfile()) }}"
  canitem="{{ Auth::User() !== null && Auth::User()->isSellerProfile() }}"
  canwishlist="{{ Auth::User() !== null && (Auth::User()->isBuyerProfile() || Auth::User()->isSellerProfile()) }}"
  cannotifications="{{ Auth::User() !== null && (Auth::User()->isBuyerProfile() || Auth::User()->isSellerProfile()) }}"
  :instantsearch="false"
  :authdata="{{ Auth::User() !== null ? Auth::User() : '{}' }}"
  :countitemsdata="{{ Auth::User() !== null  ? count(Auth::User()->getItems()) : 0 }}"
  :notificationsdata="{{ Auth::User() !== null  ? Auth::User()->getNotifications() : '[]' }}"
  sellerurl="{{ (!isset(Auth::User()->ProfileID) || (isset(Auth::User()->ProfileID) 
          && Auth::User()->ProfileID == 1)) ? 
          Auth::User() !== null ? url('seller') : url('register',1) :  '' }}"
></header-component>